<?php

namespace App\Services\Version_1\Leader_Management;


use App\Models\Leader;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Delete_Leader
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
            
        //get the leader that needs to be deleted
        $leader = Leader::where('id', $request->leaderID)->first();

        //check if the result is empty
        if($leader == null){
            return response()->json([
                'status' => 404,
                'message' => 'Leader not found',
            ]);
        }

        //delete the old image if it exists
        if($leader->photo != ''){
            Storage::delete($leader->photo);
        }

        //delete the service
        $leader->delete();
        
        return response()->json([
            'status' => 200,
            'message' => 'Leader deleted successfully',
        ],);
        
    }
}