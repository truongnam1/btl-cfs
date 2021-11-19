<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;
use Barryvdh\Debugbar\Facade as Debugbar;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class LoginController extends Controller
{

    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index(Request $request)
    {
        // $user = FacadesAuth::loginUsingId('bCDG41Jo8QSTwlEvf5zH1TOaACX2');

        if (FacadesAuth::check()) {
            return redirect()->route('admin-dashboard');
        }
        Debugbar::info($request);
        return view('admin.layout.login');
    }

    // api
    public function store(Request $request)
    {
        $accessToken = $request->get('token');
        $res = $this->verifyIdToken($accessToken);
        // return response()->json(['token' => $accessToken]);

        return $res;
    }

    public function verifyIdToken(Request $request, $idToken)
    {
        // $idTokenString = '...';
        // $verifiedIdToken = "";

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken, true);
        } catch (InvalidToken $e) {
            // echo 'The token is invalid: ' . $e->getMessage();
            return response()->json([
                'error' => 'Token không hợp lệ',
                'status' => false
            ]);
        } catch (\InvalidArgumentException $e) {
            // echo 'The token could not be parsed: ' . $e->getMessage();
            return response()->json([
                'error' => 'Lỗi xác thực',
                'status' => false
            ]);
        } catch (RevokedIdToken $e) {
            return response()->json([
                'error' => 'Phiên làm việc đã hết hạn',
                'status' => false
            ]);
        }

        // if you're using lcobucci/jwt ^4.0
        $dataUser = $verifiedIdToken->claims()->all();
        // or, if you're using lcobucci/jwt ^3.0
        $uid = $verifiedIdToken->claims()->get('sub');


        // $user = $auth->getUser($uid);
        // dd($verifiedIdToken);
        $user = FacadesAuth::loginUsingId($uid);
        if ($user) {
            return response()->json([
                'data' => $dataUser,
                'status' => true,
                'user' => $user,
            ]);
        } else
            return response()->json([
                'error' => 'đăng nhập thất bại',
                'status' => false
            ]);
    }

    public function signOut()
    {
        FacadesAuth::logout();
        return redirect()->route('admin-login');
    }

    public function signIn(Request $request)
    {
        // $idTokenString = '...';
        // $verifiedIdToken = "";
        $token = $request->get('token');

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($token, true);
        } catch (InvalidToken $e) {
            // echo 'The token is invalid: ' . $e->getMessage();
            return view('admin.layout.login');
            // return response()->json([
            //     'error' => 'Token không hợp lệ',
            //     'status' => false
            // ]);
        } catch (\InvalidArgumentException $e) {
            return view('admin.layout.login');

            // return response()->json([
            //     'error' => 'Lỗi xác thực',
            //     'status' => false
            // ]);
        } catch (RevokedIdToken $e) {
            return view('admin.layout.login');
            // return response()->json([
            //     'error' => 'Phiên làm việc đã hết hạn',
            //     'status' => false
            // ]);
        }


        $uid = $verifiedIdToken->claims()->get('sub');

        FacadesAuth::loginUsingId($uid);

        if (FacadesAuth::check()) {
            return view('admin.layout.prossesing');
        } else {
            return view('admin.layout.login');
            // return response()->json([
            //     'error' => 'đăng nhập thất bại',
            //     'status' => false
            // ]);
        }
    }

    public function testToken(Request $request)
    {
        if ($request->has('token')) {
            $token = $request->get('token');
            $verifiedIdToken = $this->auth->verifyIdToken($token, true);
            $uid = $verifiedIdToken->claims()->get('sub');
            return response()->json([
                'request' => $request->all(),
                'data' =>$verifiedIdToken->claims()->all(),
            ]);
        }

        if ($request->has('tokenGoogle')) {
            $tokenGoogle = $request->get('tokenGoogle');
            $signInResult = $this->auth->signInWithGoogleIdToken($tokenGoogle);
            return response()->json([
                'request' => $request->all(),
                'res' => $signInResult->data(),

            ]);
        }

        //  $user = FacadesAuth::loginUsingId($uid);
        // return response()->json([
        //     // 'request' => $request->all(),
        //     'uid' => $uid,
        //     'ss' => ''
        // ]);
        return "ok";
    }
    public function forgotPassword()
    {
        return view('admin.layout.forgot-password');

    }

}
