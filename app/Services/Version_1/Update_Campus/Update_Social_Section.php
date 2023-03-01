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
            
        //fetch the social after authorization
        $social = Social::where('campusID', $request->campusID)->first();

        $social->facebookLink = $request->facebookLink;
        $social->telegramLink = $request->telegramLink;
        $social->instagramLink = $request->instagramLink;
        $social->youtubeLink = $request->youtubeLink;
        $social->tiktokLink = $request->tiktokLink;

        $social->save();

        return response()->json([
            'status' => 200,
            'message' => 'Update successful!',
        ]);

        
    }
}