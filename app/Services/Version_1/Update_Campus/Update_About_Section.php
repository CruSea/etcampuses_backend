<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\About;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Version_1\Utils\GetEmailFromToken;

class Update_About_Section
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
            
        //fetch the about after authorization
        $about = About::where('campusID', $request->campusID)->first();

        //check if logo is uploaded
        if ($request->hasFile('logo')) {
            //image validation
            $validated = $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            //delete the old image if it exists
            if($about->logo != ''){
                Storage::delete($about->logo);
            }                

            $path = $request->logo->storePublicly('about_logo','public');
            $about->logo = $path;
        }

        //check if background image is uploaded
        if ($request->hasFile('bgImage')) {
            //image validation
            $validated = $request->validate([
                'bgImage' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            //delete the old image if it exists
            if($about->bgImage != ''){
                Storage::delete($about->bgImage);
            }                

            $path = $request->bgImage->storePublicly('about_bgImage','public');
            $about->bgImage = $path;
        }


        //modifying title is not allowed for now
        //$about->title = $request->title;

        $about->description = $request->description;

        $about->save();

        return response()->json([
            'status' => 200,
            'message' => 'Update successful!',
        ]);

        
    }
}