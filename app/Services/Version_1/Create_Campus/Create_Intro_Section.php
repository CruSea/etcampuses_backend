<?php

namespace App\Services\Version_1\Create_Campus;

use Illuminate\Http\Request;
use App\Models\Intro;

class Create_Intro_Section
{
    public function handle(int $id)
    {
        $intro = new Intro();
        $intro->campusID = $id;
        $intro->title = 'Welcome Message';
        $intro->message = 'Put your welcome message here';
        $intro->author = 'Author Name';
        $intro->authorPosition = 'Author Position';
        $intro->image = '';
        $intro->save();
    }
}