<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\Version_1\Auth\UserAuthenticate;

class AuthenticateUser2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = new UserAuthenticate();

        $response =$auth->handle($request);

        if($response == -1){
            return response()->json([
                'status' => 403,
                'message' => "Token not provided! Please provide a token in your request.",
            ]);
        }

        else if($response == 0){
            return response()->json([
                'status' => 403,
                'message' => 'Invalid token!'
            ]);
        }
        
        return $next($request);
    }
}
