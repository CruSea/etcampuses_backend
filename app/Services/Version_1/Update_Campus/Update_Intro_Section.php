<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\Intro;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Update_Intro_Section
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
            
        //fetch the intro after authorization
        $intro = Intro::where('campusID', $request->campusID)->first();

        //check if file is uploaded
        if ($request->hasFile('image')) {
            //image validation
            $validated = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            //delete the old image if it exists
            if ($intro->image != '') {
                Storage::delete($intro->image);
            }

            $path = $request->image->storePublicly('intro','public');
            $intro->image = $path;
        }

        $intro->title = $request->title;
        $intro->message = $request->message;
        $intro->author = $request->author;
        $intro->authorPosition = $request->authorPosition;

        $intro->save();

        return response()->json([
            'status' => 200,
            'message' => 'Update successful!',
        ]);

        
    }
}