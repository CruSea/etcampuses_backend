<?php

namespace App\Services\Version_1\Create_Campus;

use Illuminate\Http\Request;
use App\Models\Fellowship;

class Create_Fellowship_Section
{
    public function handle(int $id)
    {
        $fellowship = new Fellowship();
        $fellowship->campusID = $id;
        $fellowship->title = 'Our Fellowship';
        $fellowship->members = 1000;
        $fellowship->membersCaption = 'Members';
        $fellowship->teams = 7;
        $fellowship->teamsCaption = 'Teams';
        $fellowship->services = 10;
        $fellowship->servicesCaption = 'Amharic Services';
        $fellowship->image = '';
        $fellowship->bgColor = 'linear-gradient(360deg, rgba(255, 33, 251, 0.45) 0%, rgba(252, 158, 28, 0.3825) 65.09%)';
        $fellowship->save();
    }
}