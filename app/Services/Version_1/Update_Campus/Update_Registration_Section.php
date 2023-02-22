<?php

namespace App\Services\Version_1\Update_Campus;


use App\Models\Registration;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Update_Registration_Section
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
        $registration = Registration::where('campusID', $request->campusID)->first();

        // some of the fields are not updated for now
        $registration->title = $request->title;
        $registration->description = $request->description;
        //$registration->firstNameCaption = $request->firstNameCaption;
        //$registration->lastNameCaption = $request->lastNameCaption;
        //$registration->cityCaption = $request->cityCaption;
        //$registration->languageCaption = $request->languageCaption;
        //$registration->sexCaption = $request->sexCaption;
        //$registration->maleCaption = $request->maleCaption;
        //$registration->femaleCaption = $request->femaleCaption;
        //$registration->phoneNumberCaption = $request->phoneNumberCaption;
        //$registration->isHostAvailableCaption = $request->isHostAvailableCaption;
        //$registration->yesCaption = $request->yesCaption;
        //$registration->noCaption =  $request->noCaption;
        //$registration->churchCaption = $request->churchCaption;
        $registration->buttonName = $request->buttonName;
        $registration->bgColor = $request->bgColor;

        $registration->save();

        return response()->json([
            'status' => 200,
            'message' => 'Update successful!',
        ]);

        
    }
}