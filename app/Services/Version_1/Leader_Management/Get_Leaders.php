<?php

namespace App\Services\Version_1\Leader_Management;


use App\Models\Leader;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Version_1\Utils\GetEmailFromToken;

class Get_Leaders
{
    public function handle(Request $request, String $campusID = '')
    {

        //if campusID is not provided, use the default value from request
        if($campusID == ''){
            $campusID = $request->campusID;
        }

        //campus admin authorization

        // first, get the user
        $user = User::where('email', GetEmailFromToken::getEmailFromToken($request->token))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ],);
        }
            
        //get all leaders for the campus
        $leaders = Leader::where('campusID', $campusID)->get();

            
        return response()->json([
            'status' => 200,
            'leaders' => $leaders,
        ],);

        
    }
}