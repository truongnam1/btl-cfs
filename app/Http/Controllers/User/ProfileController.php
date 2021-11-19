<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ProfileController extends Controller
{

    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request)
    {
        $user = FacadesAuth::user();
        $userFilebase = $this->auth->getUser($user->id);

        return view('layout.profile_page', [
            'userFirebase' => $userFilebase,
            'user_id' => $user->id,
        ]);
    }
}
