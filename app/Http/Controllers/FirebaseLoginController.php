<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseLoginController extends Controller
{
    public function index()
    {
        return view("firebase.auth-client.index");
    }
    public function loginLast()
    {
        return view("firebase.auth-client.login-last");
    }

    public function loginEmail()
    {
        return view("firebase.auth-client.login-email");
        
    }
    public function loginFacebook()
    {
        return view("firebase.auth-client.login-facebook");
        
    }
    public function loginGoogle()
    {
        return view("firebase.auth-client.login-google");
        
    }
    public function loginPhone1()
    {
        return view("firebase.auth-client.login-phone1");
        
    }
    public function loginPhone2()
    {
        return view("firebase.auth-client.login-phone2");
        
    }
    public function loginPhone3()
    {
        return view("firebase.auth-client.login-phone3");
        
    }
}
