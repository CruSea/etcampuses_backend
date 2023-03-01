<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\Gallery;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Upload_Gallery_Image
{
    public function handle(Request $request)
    {

        //campus admin authorization

        //retrieve user id from users table
        $user = User::where('email', $request->session()->get('userEmail'))->first();

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
}