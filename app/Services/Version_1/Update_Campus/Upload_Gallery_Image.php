<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\Gallery;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Services\Version_1\Utils\GetEmailFromToken;

class Upload_Gallery_Image
{
    public function handle(Request $request)
    {

        //campus admin authorization

        //retrieve user id from users table
        $user = User::where('email', GetEmailFromToken::getEmailFromToken($request->token))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $request->campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 403,
                'message' => 'Unauthorized',
            ],);
        }

        //image validation
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $gallery = new Gallery();

        $gallery->campusID = $request->campusID;
                
        $path = $request->image->storePublicly('gallery','public');
        $gallery->imageURL = $path;

        $gallery->save();

        return response()->json([
            'status' => 200,
            'message' => 'Image uploaded successfully',
        ],);
    }

    public function handleMultiple(Request $request)
    {
        //inserts multiple images

        //campus admin authorization

        //retrieve user id from users table
        $user = User::where('email', GetEmailFromToken::getEmailFromToken($request->token))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $request->campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 403,
                'message' => 'Unauthorized',
            ],);
        }

        //validation skipped - done on front end

        for($i = 0; $i < count($request->images); $i++){ 

            //count corresponds to the number of non-empty elements - not accurate

            $gallery = new Gallery();

            $gallery->campusID = $request->campusID;
                    
            $path = $request->images[$i]->storePublicly('gallery','public');
            $gallery->imageURL = $path;

            $gallery->save();                    
        }

        return response()->json([
            'status' => 200,
            'message' => 'Image(s) uploaded successfully',
        ],);
        

    }
}