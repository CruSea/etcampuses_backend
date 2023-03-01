<?php

namespace App\Services\Version_1\Leader_Management;


use App\Models\Leader;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Create_Leader
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
            
        //image validation
        $validated = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $leader = new Leader();

        $leader->campusID = $request->campusID;

        $path = $request->photo->storePublicly('leaders','public');
        $leader->photo = $path;

        $leader->name = $request->name;
        $leader->role = $request->role;            
        $leader->phone = $request->phone;
        
        if($request->telegramLink != null)
            $leader->telegramLink = $request->telegramLink;
        else
            $leader->telegramLink = '';

        if($request->facebookLink != null)
            $leader->facebookLink = $request->facebookLink;
        else
            $leader->facebookLink = '';
                            
        $leader->save();

        return response()->json([
            'status' => 200,
            'message' => 'Leader created successfully',
        ],);

        
    }
}