<?php

namespace App\Http\Controllers\API\Version_1\Create_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Admin_Management\Signup;

class SignupController extends Controller
{
    public function signup(Request $request, Signup $signup)
    {
        return $signup->handle($request);
    }
}