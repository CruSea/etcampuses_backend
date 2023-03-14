<?php

namespace App\Services\Version_1\Admin_Management;


use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Version_1\Utils\GetEmailFromToken;

class Delete_Admin
{
    public function handle(Request $request)
    {

        // check if the provided admin exists
        $admin = User::where('id', $request->adminId)->first();
        if($admin == null){
            return response()->json([
                'status' => 403,
                'message' => 'Admin does not exist!',
            ]);
        }

        // get the campus id (role) of the admin
        $role = User_Role::where('userID', $request->adminId)->first();
        if($role == null){
            return response()->json([
                'status' => 403,
                'message' => 'Admin does not have a role!',
            ]);
        }

        
    }
}