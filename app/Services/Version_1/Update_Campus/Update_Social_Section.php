<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\Social;
use App\Models\User_Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Update_Social_Section
{
    public function handle(Request $request)
    {
        //campus admin authorization

        //retrieve user id from users table
        $user = User::where('email', $request->session()->get('userEmail'))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $request->campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ],);
        }

        
    }
}