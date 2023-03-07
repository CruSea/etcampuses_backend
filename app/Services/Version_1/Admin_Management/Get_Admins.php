<?php

namespace App\Services\Version_1\Admin_Management;


use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;

class Get_Admins
{
    public function handle(Request $request)
    {
        echo "API Called!";

        //campus admin authorization

        // first, get the user
        $user = User::where('email', $request->session()->get('userEmail'))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $request->campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ],);
        }
            
        //get all admins for the campus
        $admins = User::where('campusID', $request->campusID)->get();

            
        return response()->json([
            'status' => 200,
            'leaders' => $admins,
        ],);

        
    }
}