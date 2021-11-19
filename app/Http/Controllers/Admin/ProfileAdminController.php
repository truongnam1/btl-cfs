<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Auth as FirebaseAuth;
use Barryvdh\Debugbar\Facade as Debugbar;


class ProfileAdminController extends Controller
{
    protected $auth;
    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }


    public function overview()
    {
        return view("admin.layout.profile-admin.overview", ["title" => "Thông tin tài khoản"]);
    }

    // public function setting()
    // {
    //     return view("admin.layout.profile-admin.setting", ["title" => "Chỉnh sửa thông tin tài khoản"]);

    // }

    // api

    public function getRoleUser(Request $request)
    {
      
        $userId = $this->user($request->bearerToken());
        $rolesName = User::find($userId)->roles()->get(['desc']);

       return response()->json([
           'status' => true,
           'data' => $rolesName
       ]);
    }

    public function user($tokenId)
    {
        $verifiedIdToken =  $this->auth->verifyIdToken($tokenId);
        $userId = $verifiedIdToken->claims()->get('sub');
        return $userId;
    }

}
