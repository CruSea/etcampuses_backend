<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\Welcome;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Update_Welcome_Section
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
            
        //fetch the welcome after authorization
        $welcome = Welcome::where('campusID', $request->campusID)->first();

        //check if file is uploaded
        if ($request->hasFile('image')) {
            //image validation
            $validated = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            //delete the old image if it exists
            if($welcome->image != ''){
                Storage::delete($welcome->image);
            }                

            $path = $request->image->storePublicly('welcome','public');
            $welcome->image = $path;
        }

        $welcome->title = $request->input('title');
        $welcome->campusName = $request->campusName;
        $welcome->moto = $request->moto;

        //modifying button text is not allowed for now
        //$welcome->registerButtonText = $request->registerButtonText;

        $welcome->save();

        return response()->json([
            'status' => 200,
            'message' => 'Update successful!',
        ]);

    }
}