<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;

class AuthController extends Controller
{
    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function index()
    {
        $uid = 'some-uid';
        $additionalClaims = [
            'premiumAccount' => true
        ];

        $customToken = $this->auth->createCustomToken($uid, $additionalClaims);

        $customTokenString = $customToken->toString();
        return $customTokenString;
    }
    public function getUser($id)
    {
        try {
            $user = $this->auth->getUser($id);
            return $user;
            // $user = $this->auth->getUserByEmail('user@domain.tld');
            // $user = $this->auth->getUserByPhoneNumber('+49-123-456789');
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            echo $e->getMessage();
        }
        return "rong";
    }

    public function createUser()
    {
        $userProperties = [
            'uid' => '12321212521251251229',
            'email' => 'namtao1100@gmail.com',
            'emailVerified' => false,
            // 'phoneNumber' => '+15555555900',
            'password' => 'secretPassword',
            'displayName' => 'John Doe',
            'photoUrl' => 'http://www.example.com/12345678/photo.png',
            'disabled' => false,
        ];

        $createdUser = $this->auth->createUser($userProperties);

        // This is equivalent to:

        return $createdUser;
    }

    public function updateUser($idUser)
    {
        $uid = $idUser;
        $properties = [

            'displayName' => "new"
        ];




        $updatedUser = $this->auth->updateUser($uid, $properties);


        // $request = \Kreait\Auth\Request\UpdateUser::new()
        //     ->withDisplayName('New display name');

        // $updatedUser = $this->auth->updateUser($uid, $request);
        return $properties;
    }
    public function verifyUser()
    {
        $email = "namtao100@gmail.com";
        $link = $this->auth->sendEmailVerificationLink($email);
        return $link;
    }

    public function verifyToken($token)
    {

        try {
            // $verifiedIdToken = $this->auth->verifyIdToken($token);
            $signInResult = $this->auth->signInWithCustomToken($token);
            echo "<pre>";
            // print_r($signInResult);
            echo "</pre>";
        } catch (InvalidToken $e) {
            echo 'The token is invalid: ' . $e->getMessage();
        } catch (\InvalidArgumentException $e) {
            echo 'The token could not be parsed: ' . $e->getMessage();
        }
        return "ok";
    }

    public function loginGoogle()
    {
        return view('firebase.auth-client.login-google-custom');
    }

    public function verifyIdToken(Request $request, $idToken)
    {
        // $idTokenString = '...';
        $verifiedIdToken = "";

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);
        } catch (InvalidToken $e) {
            echo 'The token is invalid: ' . $e->getMessage();
        } catch (\InvalidArgumentException $e) {
            echo 'The token could not be parsed: ' . $e->getMessage();
        }

        // if you're using lcobucci/jwt ^4.0
        $dataUser = $verifiedIdToken->claims()->all();
        // or, if you're using lcobucci/jwt ^3.0
        // $uid = $verifiedIdToken->claims()->get('sub');

        // $user = $auth->getUser($uid);
        // dd($verifiedIdToken);
        return response()->json(['res' =>$dataUser, 'ss' => $request->session()->all()
    ]);

    }
}
