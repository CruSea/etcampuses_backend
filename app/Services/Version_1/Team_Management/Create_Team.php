<?php

namespace App\Services\Version_1\Team_Management;


use App\Models\Team;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Create_Team
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
            
        $team = new Team();

        $team->campusID = $request->campusID;

        $path = $request->image->storePublicly('teams','public');
        $team->image = $path;

        $team->name = $request->name;
        $team->description = $request->description;            
                            
        $team->save();

        return response()->json([
            'status' => 200,
            'message' => 'Team created successfully',
        ],);

        
    }

    public function handleMultiple(Request $request, Array $teams)
    {
        //inserts multiple teams

        

    }

}