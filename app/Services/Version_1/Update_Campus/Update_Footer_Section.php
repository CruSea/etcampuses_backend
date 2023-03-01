<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\Footer;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Update_Footer_Section
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
            
        //fetch the footer after authorization
        $footer = Footer::where('campusID', $request->campusID)->first();

        // some of the fields are not updated for now
        //$footer->socialMediasCaption = $request->socialMediasCaption;
        //$footer->bgColor = $request->bgColor;
        //$footer->contactUsCaption = $request->contactUsCaption;
        $footer->email = $request->email;
        $footer->phone = $request->phone;
        //$footer->findUsCaption = $request->findUsCaption;
        //$footer->termsAndConditions = $request->termsAndConditions;
        //$footer->termsAndConditionsCaption = $request->termsAndConditionsCaption;
        $footer->mapLink = $request->mapLink;
        //$footer->copyrightCaption = $request->copyrightCaption;

        $footer->save();

        //call the update social media service
        $social = new Update_Social_Section();
        $social->handle($request);

        return response()->json([
            'status' => 200,
            'message' => 'Update successful!',
        ]);

        
    }
}