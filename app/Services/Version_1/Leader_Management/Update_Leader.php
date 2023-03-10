<?php

namespace App\Services\Version_1\Leader_Management;


use App\Models\Leader;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Version_1\Utils\GetEmailFromToken;

class Update_Leader
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
            
        //get the leader that needs to be updated
        $leader = Leader::where('id', $request->leaderID)->first();

        //check if the result is empty
        if($leader == null){
            return response()->json([
                'status' => 404,
                'message' => 'Leader not found',
            ]);
        }

        //check if photo is uploaded
        if ($request->hasFile('photo')) {
            //image validation
            $validated = $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            //delete the old image if it exists
            if($leader->photo != ''){
                Storage::delete($leader->photo);
            }                

            $path = $request->photo->storePublicly('leaders','public');
            $leader->photo = $path;
        }

        //update the service
        $leader->name = $request->name;
        $leader->role = $request->role;            
        $leader->phone = $request->phone;

        if($request->telegramLink != null)
            $leader->telegramLink = $request->telegramLink;
        else
            $leader->telegramLink = '';

        if($request->facebookLink != null)
            $leader->facebookLink = $request->facebookLink;
        else
            $leader->facebookLink = '';

        $leader->save();
        
        return response()->json([
            'status' => 200,
            'message' => 'Leader updated successfully',
        ],);

        
    }
}