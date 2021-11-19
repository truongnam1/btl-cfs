<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Exception\Auth\EmailExists;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\AuthException;
use Spatie\Permission\Models\Role;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Cache;
use Kreait\Firebase\Request\UpdateUser;

use function PHPUnit\Framework\isEmpty;

class ManageUserController extends Controller
{
    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {

        return view('admin.layout.manage-user.users', ['title' => 'Quản lý người dùng']);
    }

    public function profileUser($idUser)
    {
        try {
            $usersFirebase = $this->auth->getUser($idUser);
            $roles = User::find($idUser)->roles;
            Debugbar::info($roles);

            return view('admin.layout.manage-user.overview', ['title' => 'Nguời dùng', 'dataUser' => $usersFirebase, 'roles' => $roles]);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $data = [
            "profile" => [
                "fullname" => "Nguyễn Thị Thanh",
                "phone" => "+84333203000",
                "email" => "lunglinh@gmail.com",
                "role" => [
                    2 => "Người dùng"
                ],
                "urlAvt" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
            ]
        ];
        return view('admin.layout.manage-user.overview', ['title' => 'Nguời dùng', 'dataUser' => $data]);
    }

    // phần dưới dành cho api
    public function registerUser(Request $request)
    {
        $fullname = $request->get('fullname');
        $email = $request->get('email');
        $activeAcc = $request->boolean('activeAccount');
        $roles = $request->get('role');
        // $phoneNumber = $request->get('phoneNumber');

        $userProperties = [
            'email' => $email,
            'emailVerified' => false,
            // 'phoneNumber' => $phoneNumber,
            'password' => '123456',
            'displayName' => $fullname,
            'photoUrl' => 'https://hinhnen123.com/wp-content/uploads/2021/06/avt-cute-9.jpg',
            // 'disabled' => true,
        ];

        $createdUser = '';
        try {
            $createdUser = $this->auth->createUser($userProperties);
            if (!$activeAcc) {
                $createdUser =  $this->auth->disableUser($createdUser->uid);
            }
            $this->auth->setCustomUserClaims($createdUser->uid, ['roles' => ['user']]);
        } catch (EmailExists $e) {
            return response()->json([
                'status' => false,
                'error' => 'Email đã tồn tại',
                'request' => $request->all()
            ],);
        }

        $user = User::create([
            'id' => $createdUser->uid,
            'name' => $fullname,
            'isActive' => !$createdUser->disabled,
            'register_at' => $createdUser->metadata->createdAt,
        ]);

        if ($roles == null) {
            $user->assignRole('user');
        } else if (Role::find($roles)->count() == count($roles)) {
            $user->assignRole($roles);
        }


        return response()->json([
            'data' => $user,
            'status' => true,
            'request' => $request->all(),
            'firebase' => $createdUser,
            'activeAcc' => $activeAcc,
            'request->boolean' => $request->boolean('activeAccount')

        ]);
    }

    public function getUsersTable(Request $request)
    {
        Debugbar::startMeasure('render', 'Time for rendering');
        Debugbar::stopMeasure('render');
        Debugbar::addMeasure('now', LARAVEL_START, microtime(true));
        $limit = (int)$request->input('length');
        $start = (int)$request->get('start');

        $colOrder = $request->get('order')[0]['column'];
        $typeOrder = $request->get('order')[0]['dir'];
        $columns  = $request->get('columns');
        $colNameOrder = $columns[$colOrder]['data'];


        $total_data = User::count();

        $data = [];
        $users = '';
        $recordsFiltered = '';
        if ($colNameOrder == 'register_at' && $typeOrder != null) {
            $users  = User::orderBy('register_at', $typeOrder)->skip($start)->limit($limit)->with('roles')->get();
        } else {
            $users  = User::skip($start)->limit($limit)->with('roles')->get();
        }
        $recordsFiltered = count($users);


        $temp = [];

        $arrUserId = [];

        foreach ($users as $user) {
            $temp['id'] = $user['id'];
            $temp['user'] = '';
            $temp['roles'] = $user->roles;
            $temp['registerAt'] = $user['register_at'];
            $temp['statusAcc'] = $user['isActive'];
            $temp['action'] = '';
            array_push($data, $temp);
            array_push($arrUserId, $user['id']);
        }
        $md5ArrIdUsers = md5(implode('', $arrUserId));

        $usersFirebase = '';
        $usersFirebase = Cache::remember('usersFireBase_' . $recordsFiltered . $md5ArrIdUsers, 15, function () use ($arrUserId) {
            return $this->auth->getUsers($arrUserId);
        });


        foreach ($data as  $index => $user) {
            $data[$index]['user'] = [
                'name' => $usersFirebase[$user['id']]->displayName,
                'photoUrl' => $usersFirebase[$user['id']]->photoUrl,
                'urlProfile' => route('manage-profile-user', ['idUser' => $user['id']]),
            ];

            $data[$index]['action'] = [
                'urlProfile' => route('manage-profile-user', ['idUser' => $user['id']]),
            ];
        }

        return  [
            'draw' => (int)$request->input('draw'),
            'recordsTotal' => $total_data,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            // 'users' => $users,
            // 'request' => $request->except(['draw','_']),
            // 'colOrder' => $colOrder,
            // 'typeOrder' => $typeOrder,
            'md5ArrUser' =>  $md5ArrIdUsers,
        ];
    }

    public function getUserTable($idUser)
    {
        try {
            $userFirebase = $this->auth->getUser($idUser);
            $user = User::find($idUser);
            $roles = $user->roles;
            $temp = [];
            $temp['id'] = $idUser;
            $temp['user'] = '';
            $temp['registerAt'] = $user->register_at;
            $temp['user'] = [
                'name' => $userFirebase->displayName,
                'photoUrl' => $userFirebase->photoUrl,
                'urlProfile' => route('manage-profile-user', ['idUser' => $idUser]),
            ];

            $temp['roles'] =  $roles;
            $temp['statusAcc'] = !$userFirebase->disabled;
            $temp['action'] = [
                'urlProfile' => route('manage-profile-user', ['idUser' => $idUser]),
            ];

            return response()->json([
                'status' => true,
                'data' => $temp,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'data' => 'Lỗi lấy dữ liệu người dùng',
            ]);
        }
    }


    public function createMultiUser($number)
    {
        $arrUser = [];
        $faker = Faker::create();
        for ($i = 0; $i < $number; $i++) {
            $userProperties = [
                'email' => $faker->email,
                'emailVerified' => false,
                'phoneNumber' => $faker->e164PhoneNumber,
                'password' => '123456',
                'displayName' => $faker->name,
                'photoUrl' => 'https://hinhnen123.com/wp-content/uploads/2021/06/avt-cute-9.jpg',
                'disabled' => false,
            ];
            $createdUser = $this->auth->createUser($userProperties);

            $user = User::create([
                'id' => $createdUser->uid,
                'name' => $createdUser->displayName,
                'isActive' => !$createdUser->disabled,
                'register_at' => $createdUser->metadata->createdAt,
            ]);

            $arrUser[] = $createdUser;
        }

        return [
            'users' => $arrUser
        ];
    }

    public function disableUser($idUser)
    {
        if ($this->isUser($idUser)) {
            try {
                $updatedUser = $this->auth->disableUser($idUser);
                User::find($idUser)->update(['isActive' => false]);

                $data = $this->getUserTable($idUser)->getData()->data;
                return response()->json([
                    'status' => true,
                    'data' => $data
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'error' => 'Lỗi khoá người dùng'
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'error' => 'Người dùng không tồn tại'

        ]);
    }

    public function activeUser($idUser)
    {
        if ($this->isUser($idUser)) {
            try {
                $updatedUser = $this->auth->enableUser($idUser);
                User::find($idUser)->update(['isActive' => true]);
                $data = $this->getUserTable($idUser)->getData()->data;
                return response()->json([
                    'status' => true,
                    'data' => $data
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'error' => 'Lỗi kích hoạt người dùng'
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'error' => 'Người dùng không tồn tại'

        ]);
    }

    protected function isUser($idUser)
    {
        $user = User::where('id', $idUser)->count();
        return $user == 1 ? true : false;
    }

    public function deleteUser($idUser)
    {
        $user = User::find($idUser);

        if ($user) {

            try {
                $this->auth->deleteUser($idUser);
                $user->delete();

                return response()->json([
                    'status' => true,
                    'error' => 'Đã xoá tài khoản thành công'
                ]);
            } catch (UserNotFound $e) {
                return response()->json([
                    'status' => false,
                    'error' => 'Người dùng không tồn tại firebase'
                ]);
            } catch (AuthException $e) {
                return response()->json([
                    'status' => false,
                    'error' => 'Lỗi xoá người dùng'
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'error' => 'Người dùng không tồn tại mysql'
        ]);
    }

    public function updateProfileUser(Request $request, $userId)
    {
        $fullname = $request->get('fullname');
        $roles = $request->get('roles');
        $statusAcc = $request->boolean('statusAcc');


        if ($this->isUser($userId)) {
            try {
                $amountRoles = Role::find($roles)->count();
                if ($amountRoles == count($roles)) {
                    $user = User::find($userId);
                    $user->syncRoles($roles);
                    $user->update([
                        'isActive' => $statusAcc
                    ]);
                    $roleName = $user->getRoleNames();

                    $updatedUser = $this->auth->updateUser($userId, [
                        'displayName' =>  $fullname
                    ]);
                    if ($statusAcc) {
                        $this->activeUser($userId);
                    } else {
                        $this->disableUser($userId);
                    }
                    $this->auth->setCustomUserClaims($userId, ['roles' => $roleName]);
                    $data = $this->getUserTable($userId)->getData()->data;


                    return response()->json([
                        'status' => true,
                        'data' => $data
                    ]);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'error' => $th->getMessage()
                ]);
            }
        }
    }

    public function sendEmailResetPassword($userId)
    {
        $user = $this->auth->getUser($userId);
        $link = $this->auth->sendPasswordResetLink($user->email);

        return response()->json([
            'status' => true,
            'data' => $link
        ]);
    }

    public function getAllUserFirebase()
    {
        $users = $this->auth->listUsers();
        $arr = [];
        foreach ($users as $user) {
            array_push($arr, $user);
        }

        return response()->json(['total' => count($arr), 'users' => $arr]);
    }

    public function deleteAllUserFirebase()
    {
        $users = $this->auth->listUsers();
        $arrUid = [];
        foreach ($users as $user) {
            array_push($arrUid, $user->uid);
        }

        $forceDeleteEnabledUsers = true; // default: false
        $result = $this->auth->deleteUsers($arrUid, $forceDeleteEnabledUsers);

        return response()->json(['res' => $result]);
    }
}
