<?php

namespace App\Services\Version_1\Team_Management;


use App\Models\Team;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Version_1\Utils\GetEmailFromToken;

class Create_Team
{
    public function handle(Request $request)
    {
        //campus admin authorization

        // first, get the user
        $user = User::where('email', GetEmailFromToken::getEmailFromToken($request->token))->first();

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

    public function handleMultiple(Request $request)
    {
        //inserts multiple teams

        //campus admin authorization

        // first, get the user
        $user = User::where('email', GetEmailFromToken::getEmailFromToken($request->token))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $request->campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ],);
        }

        //image validation skipped - done in front-end

        for($i = 0; $i < count($request->teams); $i++){
            $team = new Team();

            $team->campusID = $request->campusID;

            $path = $request->teams[$i]['image']->storePublicly('teams','public');
            $team->image = $path;

            $team->name = $request->teams[$i]['name'];
            $team->description = $request->teams[$i]['description'];            
                                
            $team->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Team(s) created successfully',
        ],);

    }

}