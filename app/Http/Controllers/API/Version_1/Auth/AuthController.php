<?php

namespace App\Http\Controllers\API\Version_1\Auth;

use App\Http\Controllers\Controller;
use App\Services\Version_1\Auth\Login;
use App\Services\Version_1\Auth\Logout;
use App\Services\Version_1\Auth\ChangePassword;
use App\Services\Version_1\Auth\PasswordResetRequest;
use App\Services\Version_1\Auth\PasswordReset;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(Login $login, Request $request)
    {
        return $login->handle($request);
    }

    public function logout(Logout $logout, Request $request)
    {
        return $logout->handle($request);
    }

    public function changePassword(ChangePassword $changePassword, Request $request)
    {
        return $changePassword->handle($request);
    }

    public function passwordResetRequest(PasswordResetRequest $passwordResetRequest, Request $request)
    {
        return $passwordResetRequest->handle($request);
    }

    public function passwordReset(PasswordReset $passwordReset, Request $request)
    {
        return $passwordReset->handle($request);
    }
}