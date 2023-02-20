<?php

namespace App\Http\Controllers\API\Version_1\Create_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Admin_Management\Create_Admin;

class SignupController extends Controller
{
    public function signup(Request $request, Create_Admin $createAdmin)
    {
        return $createAdmin->handle($request);
    }
}