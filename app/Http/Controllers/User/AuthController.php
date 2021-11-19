<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\Auth\EmailExists;
use Spatie\Permission\Models\Role;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function register(Request $request)
    {
        $token = $request->get('token');
        $verifyIdToken = '';
        try {
            $verifyIdToken = $this->auth->verifyIdToken($token, true);
        } catch (InvalidToken $e) {

            return view('layout.home_page');
            // return response()->json([
            //     'error' => 'Token không hợp lệ',
            //     'status' => false
            // ]);
        } catch (\InvalidArgumentException $e) {
            return view('layout.home_page');

            // return response()->json([
            //     'error' => 'Lỗi xác thực',
            //     'status' => false
            // ]);
        } catch (RevokedIdToken $e) {
            return view('layout.home_page');
            // return response()->json([
            //     'error' => 'Phiên làm việc đã hết hạn',
            //     'status' => false
            // ]);
        }
        $uid = $verifyIdToken->claims()->get('sub');
        $userFirebase = $this->auth->getUser($uid);

        $user = '';
        if ($userFirebase) {
            $user = User::create([
                'id' =>  $uid,
                'name' => $userFirebase->displayName ?? 'Chưa đặt tên',
                'isActive' => true,
                'register_at' => $userFirebase->metadata->createdAt,
            ]);
            FacadesAuth::loginUsingId($userFirebase->uid);
            $user->assignRole('user');

            return redirect()->route('home');
        }
    }

    public function signOut()
    {
        FacadesAuth::logout();
        return redirect()->route('home_page');
    }

    public function login(Request $request)
    {
        $token = $request->get('token');

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($token, true);
        } catch (InvalidToken $e) {
            // echo 'The token is invalid: ' . $e->getMessage();
            return view('layout.home_page');
            // return response()->json([
            //     'error' => 'Token không hợp lệ',
            //     'status' => false
            // ]);
        } catch (\InvalidArgumentException $e) {
            return view('layout.home_page');

            // return response()->json([
            //     'error' => 'Lỗi xác thực',
            //     'status' => false
            // ]);
        } catch (RevokedIdToken $e) {
            return view('layout.home_page');
            // return response()->json([
            //     'error' => 'Phiên làm việc đã hết hạn',
            //     'status' => false
            // ]);
        }


        $uid = $verifiedIdToken->claims()->get('sub');

        FacadesAuth::loginUsingId($uid);

        if (FacadesAuth::check()) {
            return view('layout.processing');
        } else {
            return view('layout.home_page');
            // return response()->json([
            //     'error' => 'đăng nhập thất bại',
            //     'status' => false
            // ]);
        }
    }
}
