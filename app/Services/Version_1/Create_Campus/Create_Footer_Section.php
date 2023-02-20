<?php

namespace App\Services\Version_1\Create_Campus;

use Illuminate\Http\Request;
use App\Models\Footer;

class Create_Footer_Section
{
    public function handle(int $id)
    {
        $footer = new Footer();
        $footer->campusID = $id;
        $footer->socialMediasCaption = 'Social Medias';
        $footer->bgColor = '#05419B';
        $footer->contactUsCaption = 'Contact us';
        $footer->email = 'your_campus_email@gmail.com';
        $footer->phone = 'your_contact_phone_number';
        $footer->findUsCaption = 'Find us';
        $footer->termsAndConditions = 'Place your terms and conditions here';
        $footer->termsAndConditionsCaption = 'Terms and Conditions';
        $footer->mapLink = '<Your Google map link>';
        $footer->copyrightCaption = 'Copyright 2023';
        $footer->save();
    }
}