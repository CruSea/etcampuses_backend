<?php

namespace App\Services\Version_1\View_Campus;


use App\Models\Campus;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use App\Models\Welcome;
use App\Models\Intro;
use App\Models\City;
use App\Models\About;
use App\Models\Fellowship;
use App\Models\Registration;
use App\Models\Footer;
use App\Models\Social;
use App\Models\Gallery;
use App\Services\Version_1\Service_Management\Get_Services;
use App\Services\Version_1\Team_Management\Get_Teams;
use App\Services\Version_1\Leader_Management\Get_Leaders;
use App\Services\Version_1\Utils\GetEmailFromToken;

class View_Campus
{
    public function handle(Request $request)
    {

        //view all campuses created by the admin

        //get the user first
        $user = User::where('email', GetEmailFromToken::getEmailFromToken($request->token))->first();

        //get the campuses created by the admin
        $roles = User_Role::where('userID', $user->id)->get();

        if($roles == '[]'){
            return response()->json([
                'message' => 'You haven\'t created any campuses yet',      
            ]);
        }

        $responses = '';

        foreach ($roles as $role) {
            $campus = Campus::where('id', [$role->role])->first();
            echo response()->json([
                    'campusID' => $role->role,
                    'content' => $this->getCampusDetails($campus->id, $request),
                ]);

            $this->getCampusDetails($campus->id, $request);
        }
        
    }

    public function getCampusDetails(String $campusID, Request $request){

        //fetch the welcome that corresponds to the campusID
        $welcome = Welcome::where('campusID', $campusID)->first();

        //fetch the intro that corresponds to the campusID
        $intro = Intro::where('campusID', $campusID)->first();

        //fetch the city that corresponds to the campusID
        $city = City::where('campusID', $campusID)->first();

        //fetch the about that corresponds to the campusID
        $about = About::where('campusID', $campusID)->first();

        //fetch the fellowship that corresponds to the campusID
        $fellowship = Fellowship::where('campusID', $campusID)->first();

        //fetch the services that correspond to the campusID
        $get_Services = new Get_Services();
        $services = $get_Services->handle($request, $campusID);

        //fetch the teams that correspond to the campusID
        $get_Teams = new Get_Teams();
        $teams = $get_Teams->handle($request, $campusID);

        //fetch the leaders that correspond to the campusID
        $get_Leaders = new Get_Leaders();
        $leaders = $get_Leaders->handle($request, $campusID);

        //Visibility of form
        $registration = Registration::where('campusID', $campusID)->first();
        //decode the visibility
        if($registration->isVisible == 1){
            $formVisibility = true;
        }
        else{
            $formVisibility = false;
        }

        //fetch the gallery that correspond to the campusID
        $gallery = Gallery::where('campusID', $campusID)->first();

        //fetch the footer that correspond to the campusID
        $footer = Footer::where('campusID', $campusID)->first();

        //fetch the social media that correspond to the campusID
        $social = Social::where('campusID', $campusID)->first();

        //preapare an organized response
        return response()->json([
            'status' => '200',
            'Welcome Section Contents: ' => $welcome,
            'Intro Section Contents: ' => $intro,
            'City Section Contents: ' => $city,
            'About Section Contents: ' => $about,
            'Fellowship Section Contents: ' => $fellowship,
            'Service Section Contents: ' => $services,
            'Team Section Contents: ' => $teams,
            'Leader Section Contents: ' => $leaders,

            //Visibility of form
            'Registration Form Visibility: ' => $formVisibility,

            'Gallery Section Contents: ' => $gallery,
            'Footer Section Contents: ' => $footer,
            'Social Medias: ' => $social
        ]);
    }
}