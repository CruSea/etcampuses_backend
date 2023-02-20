<?php

namespace App\Services\Version_1\Create_Campus;

use Illuminate\Http\Request;
use App\Models\City;

class Create_City_Section
{
    public function handle(int $id)
    {
        $city = new City();
        $city->campusID = $id;
        $city->title = 'Our City';
        $city->description = 'Say something about your city';
        $city->name = 'Your City Name';
        $city->save();
    }
}