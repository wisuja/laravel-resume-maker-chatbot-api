<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException){
                $response = [
                    'message' => 'Token is invalid.',
                    'data' => [
                        'error' => 'Token is invalid.'
                    ]
                ];
                return response($response, 400);
            }else if ($e instanceof TokenExpiredException){
                $response = [
                    'message' => 'Token is expired.',
                    'data' => [
                        'error' => 'Token is expired.'
                    ]
                ];
                return response($response, 400);
            }else{
                $response = [
                    'message' => 'Token not found.',
                    'data' => [
                        'error' => 'Token not found.'
                    ]
                ];
                return response($response, 400);
            }
        }
        return $next($request);
    }
}
