<?php

namespace App\Services\Version_1\Team_Management;


use App\Models\Team;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Delete_Team
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
            
        //get the team that needs to be deleted
        $team = Team::where('id', $request->teamID)->first();

        //check if the result is empty
        if($team == null){
            return response()->json([
                'status' => 404,
                'message' => 'Team not found',
            ]);
        }

        //delete the image if it exists
        if($team->image != ''){
            Storage::delete($team->image);
        }

        //delete the Team
        $team->delete();
        
        return response()->json([
            'status' => 200,
            'message' => 'Team deleted successfully',
        ],);

        
    }
}