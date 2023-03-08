<?php

namespace App\Services\Version_1\Create_Campus;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Campus;
use App\Models\User;
use App\Models\User_Role;
use App\Services\Version_1\Admin_Management\Create_Admin;
use Illuminate\Support\Str;

class Create_Campus
{
    public function handle(Request $request)
    {

        //get user from session
        $user = User::where('email', $request->session()->get('userEmail'))->first();
        //get the id of the user
        $adminID = $user->id;

        $campus = new Campus();
        $campus->services_Title = 'Regular Programs';
        $campus->teams_Title = 'Teams waiting you';
        $campus->teams_Description = '<General description about your teams>';
        $campus->leaders_Title = 'Our Leaders';
        $campus->leaders_BgColor = 'rgba(3, 163, 245, 0.09)';
        $campus->gallery_Title = 'Gallery';
        $campus->owner = $user->firstName . ' ' . $user->lastName;        
        $campus->url = ''; //just for placeholder, modified below
        $campus->save();

        $newURL = (string) Str::uuid(); // generate new URL for campus

        //set campus URL
        $campus->url = $campus->id . $newURL; //campus ID is seeded to ensure uniqueness

        $campus->save();

        //create welcome instance     
        $welcome = new Create_Welcome_Section();
        $welcome->handle($campus->id);

        //create intro instance
        $intro = new Create_Intro_Section();
        $intro->handle($campus->id);

        //create city instance
        $city = new Create_City_Section();
        $city->handle($campus->id);

        //create about instance
        $about = new Create_About_Section();
        $about->handle($campus->id);

        //create fellowship instance
        $fellowship = new Create_Fellowship_Section();
        $fellowship->handle($campus->id);

        //create registration instance
        $registration = new Create_Registration_Section();
        $registration->handle($campus->id);

        //create footer instance
        $footer = new Create_Footer_Section();
        $footer->handle($campus->id);

        //create social instance
        $social = new Create_Social_Section();
        $social->handle($campus->id);

        
        //associate the admin with the campus
        $user_role = new User_Role();
        $user_role->userID = $adminID;
        $user_role->role = $campus->id;
        $user_role->save();

        return response()->json([
            'status' => 200,
            'message' => 'Campus created successfully!',
            'Newly created campus ID' => $campus->id,
            'Campus URL' => $campus->url,
        ]);
    }
}