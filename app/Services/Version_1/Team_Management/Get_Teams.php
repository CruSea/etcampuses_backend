<?php

namespace App\Services\Version_1\Team_Management;


use App\Models\Team;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Get_Teams
{
    public function handle(Request $request)
    {
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
            
        //get all teams for the campus
        $teams = Team::where('campusID', $request->campusID)->get();

        
        return response()->json([
            'status' => 200,
            'teams' => $teams,
        ],);

        
    }
}