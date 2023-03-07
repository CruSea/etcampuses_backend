<?php

namespace App\Http\Controllers\API\Version_1\Admin_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Admin_Management\Get_Admins;


class AdminManagementController extends Controller
{
    public function get_Admins(Get_Admins $getAdmins, Request $request)
    {
        return $getAdmins->handle($request);
    }

   
}