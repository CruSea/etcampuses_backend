<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\Fellowship;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Update_Fellowship_Section
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
            
        //fetch the fellowship after authorization
        $fellowship = Fellowship::where('campusID', $request->campusID)->first();

        //check if file is uploaded
        if ($request->hasFile('image')) {
            //image validation
            $validated = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            //delete the old image if it exists
            if ($fellowship->image != '') {
                Storage::delete($fellowship->image);
            }

            $path = $request->image->storePublicly('fellowship','public');
            $fellowship->image = $path;
        }

        //modifying this feature is not allowed for now
        //$fellowship->title = $request->title;

        $fellowship->members = $request->members;
        //$fellowship->membersCaption = $request->membersCaption;   //not currently updated
        $fellowship->teams = $request->teams;
        //$fellowship->teamsCaption = $request->teamsCaption;    //not currently updated
        $fellowship->services = $request->services;
        //$fellowship->servicesCaption = $request->servicesCaption;    //not currently updated

        //modifying this feature is not allowed for now
        //$fellowship->bgColor = $request->bgColor;

        $fellowship->save();

        return response()->json([
            'status' => 200,
            'message' => 'Update successful!',
        ]);

        
    }
}