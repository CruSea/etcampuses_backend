<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\Gallery;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Delete_Gallery_Image
{
    public function handle(Request $request)
    {
        $gallery = Gallery::where('imageURL',$request->imageURL)->first();
            if($gallery == null){
                return response()->json([
                    'status' => 404,
                    'message' => 'Image not found!',
                ],);
            }

        //make sure the image belongs to the campus admin

        //retrieve user id from users table
        $user = User::where('email', $request->session()->get('userEmail'))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $gallery->campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 403,
                'message' => 'Unauthorized',
            ],);
        }

        $gallery->delete();

        Storage::disk('public')->delete($request->imageURL);

        return response()->json([
            'status' => 200,
            'message' => 'Image deleted successfully',
        ],);

    }
}