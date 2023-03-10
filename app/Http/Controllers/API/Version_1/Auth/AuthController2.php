<?php

namespace App\Http\Controllers\API\Version_1\Auth;

use App\Http\Controllers\Controller;
use App\Services\Version_1\Auth\UserLogin;
use App\Services\Version_1\Auth\UserLogout;
use Illuminate\Http\Request;


class AuthController2 extends Controller
{
    public function login(UserLogin $login, Request $request)
    {
        return $login->handle($request);
    }

    public function logout(UserLogout $logout, Request $request)
    {
        return $logout->handle($request);
    }

}