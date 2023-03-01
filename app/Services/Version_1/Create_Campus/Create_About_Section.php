<?php

namespace App\Services\Version_1\Create_Campus;

use Illuminate\Http\Request;
use App\Models\About;

class Create_About_Section
{
    public function handle(int $id)
    {
        $about = new About();
        $about->campusID = $id;
        $about->title = 'About Campus';
        $about->description = 'Say something about your campus';
        $about->logo = '';
        $about->bgImage = '';
        $about->save();
    }
}