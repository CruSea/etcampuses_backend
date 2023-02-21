<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\Campus;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;

class Update_Campus_Captions
{
    public function update_Gallery_Title(Request $request){

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
        
        //fetch the campus that belongs to the campus admin
        $campus = Campus::where('id', $request->campusID)->first();

        $campus->gallery_Title = $request->gallery_Title;            

        $campus->save();

        return response()->json([
            'status' => 200,
            'message' => 'Gallery title updated successfully!',
        ]);

    }

    public function update_Services_Title(Request $request){

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
        
        //fetch the campus that belongs to the campus admin
        $campus = Campus::where('id', $request->campusID)->first();

        $campus->services_Title = $request->services_Title;            

        $campus->save();

        return response()->json([
            'status' => 200,
            'message' => 'Services title updated successfully!',
        ]);
        
    }

    public function update_Teams_Title(Request $request){

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
        
        //fetch the campus that belongs to the campus admin
        $campus = Campus::where('id', $request->campusID)->first();

        $campus->teams_Title = $request->teams_Title;            

        $campus->save();

        return response()->json([
            'status' => 200,
            'message' => 'Teams title updated successfully!',
        ]);

    }

    public function update_Teams_Description(Request $request){

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
        
        //fetch the campus that belongs to the campus admin
        $campus = Campus::where('id', $request->campusID)->first();

        $campus->teams_Description = $request->teams_Description;            

        $campus->save();

        return response()->json([
            'status' => 200,
            'message' => 'Teams description updated successfully!',
        ]);

    }

    public function update_Leaders_Title(Request $request){

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
        
        //fetch the campus that belongs to the campus admin
        $campus = Campus::where('id', $request->campusID)->first();

        $campus->leaders_Title = $request->leaders_Title;            

        $campus->save();

        return response()->json([
            'status' => 200,
            'message' => 'Leaders title updated successfully!',
        ]);

    }

    public function update_Leaders_BgColor(Request $request){

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
        
        //fetch the campus that belongs to the campus admin
        $campus = Campus::where('id', $request->campusID)->first();

        $campus->leaders_BgColor = $request->leaders_BgColor;            

        $campus->save();

        return response()->json([
            'status' => 200,
            'message' => 'Leaders background color updated successfully!',
        ]);

    }
}