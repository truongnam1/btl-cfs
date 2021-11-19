<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

class ManageRoleController extends Controller
{
    // public function index()
    // {
    //    return view('admin.layout.roles', ['title' => 'Quản lý phân quyền']);
    // }

    public function viewRole(Request $request, $nameRole)
    {
        Debugbar::info($request);
        $dataViewRole = $this->getRoleView($nameRole)->getData();
        // Debugbar::info($dataViewRole->permissions);

        return view(
            'admin.layout.role.view-role',
            [
                'title' => 'Chi tiết vai trò',
                'role' => $dataViewRole->role,
                'permissions' => $dataViewRole->permissions,
                'teamNames' => $dataViewRole->teamNames,
                'roleName' => $dataViewRole->roleName,
            ]
        );
    }

    public function roleList(Request $request)
    {

        Debugbar::info($request);
        $dataRoles = $this->getRolesCard()->getData();
        return view('admin.layout.role.role-list', ['title' => 'Danh sách vai trò', 'dataRoles' => $dataRoles]);
    }

    //xử lý riêng
    public function handlePermissionAssignRole($permissions)
    {
        $teamPermissions = $permissions->groupBy('team_permission_id');
        $amountTeamPermission = $teamPermissions->count();
        return [
            'teamPermission' => $teamPermissions,
            'total' => $amountTeamPermission
        ];
    }

    public function handlePermissionAssignRoleCard($permissions)
    {
        $teamsPermissions = $permissions->groupBy('team_permission_id');
        $amountTeamPermission = $teamsPermissions->count();

        $data = [];

        foreach ($teamsPermissions as $teamPermissions) {
            $temp = [];
            $permissionAll = $teamPermissions->where('action', 'tất cả')->first();

            $teamName = $teamPermissions->first()->team_name;

            if ($permissionAll != null) {
                $temp['text']['action'] = $permissionAll->action;
            } else {
                $temp['text']['action'] = $teamPermissions->pluck('action')->join(', ');
            }
            $temp['text']['team_name'] = $teamName;
            // $temp['permissionAll'] = $permissionAll;

            array_push($data, $temp);
        }


        return [
            'teamPermission' => $data,
            'total' => $amountTeamPermission,
        ];
    }


    //api

    public function perToRole()
    {
        // $arrPer = [
        //    'posts.edit',
        //    'posts.read',
        //    'comments.*'
        // ];
        // $res = Role::findByName('mod')->givePermissionTo($arrPer);
        $user = User::find('CdyOEIoGg9Szf0v5u685zZQ6R8Q2');

        // $user->assignRole('mod');

        // $user->givePermissionTo('reacts.edit');

        // $user->getDirectPermissions();
        // $user->getPermissionsViaRoles();
        // $user->getAllPermissions();



        // return response()->json([
        //     'getDirectPermissions' => $user->getDirectPermissions(),
        //     'getPermissionsViaRoles' => $user->getPermissionsViaRoles(),
        //     'getAllPermissions' => $user->getAllPermissions(),

        // ]);


    }

    public function getRoles()
    {
        $roles = Cache::remember('get_all_role', 60, function () {
            return Role::with('permissions')->get();
        });
        // $roles = Role::with('permissions')->get();

        $data = [];
        // foreach ($roles as $key => $role) {
        //     $temp  = [];
        //     $temp['id'] = $role->id;
        //     $temp['name'] = $role->name;
        //     $temp['desc'] = $role->desc;
        //     $temp['permissions'] = $this->handlePermissionAssignRole($role->permissions);
        //     array_push($data, $temp);
        // }

        $data = Cache::remember('data_all_role', 60, function () use ($roles) {
            $dataTemp = [];
            foreach ($roles as  $role) {
                $temp  = [];
                $temp['id'] = $role->id;
                $temp['name'] = $role->name;
                $temp['desc'] = $role->desc;
                $temp['permissions'] = $this->handlePermissionAssignRole($role->permissions);
                array_push($dataTemp, $temp);
            }
            return $dataTemp;
        });



        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function getRole($nameRole)
    {
        $role = Role::select('id', 'desc')->where('name', $nameRole)->with('permissions:id')->first();
        return response()->json([
            'data' => $role,
            'status' => true
        ]);
    }

    public function getRolesCard()
    {

        $roles = Role::with('permissions:id,name,action,team_name,team_permission_id')->get();

        $data = [];
        foreach ($roles as $role) {
            $temp  = [];
            // $temp['id'] = $role->id;
            $temp['name'] = $role->name;
            $temp['desc'] = $role->desc;
            $temp['urlRole'] = route('role-viewRole', ['nameRole' => $role->name]);
            $temp['permissions'] = $this->handlePermissionAssignRoleCard($role->permissions);
            array_push($data, $temp);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function getRoleView($roleName)
    {
        $permissions = Permission::all();
        $teamPermissions = $permissions->groupBy('team_permission_id');
        $arrTeamName = $permissions->pluck('team_name', 'team_permission_id');

        $role = '';
        try {
            $role = Role::select('id', 'desc')->where('name', $roleName)->first();
        } catch (RoleDoesNotExist $e) {
        }
        return response()->json(['role' => $role, 'permissions' => $teamPermissions, 'teamNames' => $arrTeamName, 'roleName' => $roleName]);
    }

    public function updatePermissionassignRole(Request $request, $roleName)
    {
        // $res = '';
        // // $idsFalse = $request->collect('data')->where('checked', 'false')->pluck('id');
        $idsTrue = $request->collect('permissions')->where('checked', 'true')->pluck('id');
        $roleDesc = $request->get('role-desc');
        $resRole = '';
        try {
            $role = Role::findByName($roleName);
            $role->update([
                'desc' => $roleDesc
            ]);
            DB::table('role_has_permissions')->where('role_id', $role->id)->delete();

            $arr = [];
            foreach ($idsTrue as  $permissionId) {
                $temp = [];
                $temp['role_id'] = $role->id;
                $temp['permission_id'] = (int) $permissionId;
                array_push($arr, $temp);
            }

            $checkUpdate = DB::table('role_has_permissions')->insert($arr);
            if ($checkUpdate) {
                $resRole = Role::select('id', 'desc')->where('name', $roleName)->with('permissions:id')->first();

                return response()->json([
                    'status' => true,
                    'data' => $resRole,
                    'checkUpdate' => $checkUpdate

                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'error' => 'Lỗi cập nhật quyền'
            ]);
        }
    }
}
