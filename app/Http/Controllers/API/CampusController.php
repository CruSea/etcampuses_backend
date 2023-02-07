<?php

namespace App\Http\Controllers\API;

use App\Models\Campus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->session()->exists('userEmail')) {

            //Make sure this user is admin///////////////////////////////

            $campus = new Campus();
            $campus->services_Title = 'Regular Programs';
            $campus->teams_Title = 'Teams waiting you';
            $campus->teams_Description = '<General description about your teams>';
            $campus->leaders_Title = 'Our Leaders';
            $campus->leaders_BgColor = 'rgba(3, 163, 245, 0.09)';
            $campus->gallery_Title = 'Gallery';
            $campus->save();

            //create welcome instance
            $welcome = new WelcomeController();
            $welcome->create($campus->id);

            //create intro instance
            $intro = new IntroController();
            $intro->create($campus->id);

            //create city instance
            $city = new CityController();
            $city->create($campus->id);

            //create about instance
            $about = new AboutController();
            $about->create($campus->id);

            //create fellowship instance
            $fellowship = new FellowshipController();
            $fellowship->create($campus->id);

            //create registration instance
            $registration = new RegistrationController();
            $registration->create($campus->id);

            //create footer instance
            $footer = new FooterController();
            $footer->create($campus->id);

            //create social instance
            $social = new SocialController();
            $social->create($campus->id);

            return response()->json([
                'status' => 200,
                'message' => 'Campus Created Successfully!' 
            ]);


        }
        else {
            return response()->json([
                'status' => 403,
                'message' => 'Not logged in!' 
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function show(Campus $campus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function edit(Campus $campus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campus $campus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campus $campus)
    {
        //
    }
}
