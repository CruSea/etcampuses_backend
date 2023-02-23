<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\City;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Update_City_Section
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
            
        //fetch the city after authorization
        $city = City::where('campusID', $request->campusID)->first();

        //modifying title is not allowed for now
        //$city->title = $request->title;

        $city->description = $request->description;
        $city->name = $request->name;

        $city->save();

        return response()->json([
            'status' => 200,
            'message' => 'Update successful!',
        ]);

        
    }
}