<?php

namespace App\Services\Version_1\Create_Campus;

use Illuminate\Http\Request;
use App\Models\Welcome;

class Create_Welcome_Section
{
    public function handle(int $id)
    {
        $welcome = new Welcome();
        $welcome->campusID = $id;
        $welcome->image = '';
        $welcome->title = 'Welcome to <Your City>';
        $welcome->campusName = '<Your Campus Name>';
        $welcome->moto = 'Put your campus moto here';
        $welcome->registerButtonText = 'Register Now';
        $welcome->save();
    }
}