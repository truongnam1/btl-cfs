<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class AuthApi
{
    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        $userId = '';
        $verifiedIdToken = '';
        try {
            $verifiedIdToken =  $this->auth->verifyIdToken($token, true);
            $userId = $verifiedIdToken->claims()->get('sub');
        } catch (InvalidToken $e) {
            //có token nhưng token bị sai
            return response()->json([
                'error' => 'Token không hợp lệ',
                'status' => false
            ]);
        } catch (\InvalidArgumentException $e) {
            // không có token
            return response()->json([
                'error' => 'Không thể xác thực người dùng',
                'status' => false
            ]);
        } catch (RevokedIdToken $e) {
            // token hết hạn
            return response()->json([
                'error' => 'Phiên làm việc đã hết hạn',
                'status' => false
            ]);
        }

        FacadesAuth::loginUsingId($userId);

        return $next($request);
    }
}
