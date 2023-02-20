<?php

namespace App\Services\Version_1\Create_Campus;

use Illuminate\Http\Request;
use App\Models\Registration;

class Create_Registration_Section
{
    public function handle(int $id)
    {
        $registration = new Registration();
        $registration->campusID = $id;
        $registration->title = 'Haven\'t registered yet?';
        $registration->description = 'Fill this form to be part of our fellowship';
        $registration->firstNameCaption = 'First Name';
        $registration->lastNameCaption = 'Last Name';
        $registration->cityCaption = 'Your City';
        $registration->languageCaption = 'Language';
        $registration->sexCaption = 'Sex';
        $registration->maleCaption = 'Male';
        $registration->femaleCaption = 'Female';
        $registration->phoneNumberCaption = 'Phone Number';
        $registration->isHostAvailableCaption = 'Is host available?';
        $registration->yesCaption = 'Yes';
        $registration->noCaption = 'No';
        $registration->buttonName = 'Register';
        $registration->bgColor = 'rgba(255, 217, 131, 0.21)';
        $registration->save();   
    }
}