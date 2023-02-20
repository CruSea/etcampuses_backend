<?php

namespace App\Http\Controllers\API;

use App\Models\Footer;
use App\Models\CampusAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterController extends Controller
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
    public function create(int $id)
    {
        // $footer = new Footer();
        // $footer->campusID = $id;
        // $footer->socialMediasCaption = 'Social Medias';
        // $footer->bgColor = '#05419B';
        // $footer->contactUsCaption = 'Contact us';
        // $footer->email = 'your_campus_email@gmail.com';
        // $footer->phone = 'your_contact_phone_number';
        // $footer->findUsCaption = 'Find us';
        // $footer->termsAndConditions = 'Place your terms and conditions here';
        // $footer->termsAndConditionsCaption = 'Terms and Conditions';
        // $footer->mapLink = '<Your Google map link>';
        // $footer->copyrightCaption = 'Copyright 2023';
        // $footer->save();
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
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function show(Footer $footer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function edit(Footer $footer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // SOME FIELDS ARE NOT UPDATED FOR NOW

        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the footer that belongs to the campus admin
            $footer = Footer::where('campusID', $campusAdmin->campusID)->first();
            
            // some of the fields are not updated for now
            $footer->socialMediasCaption = $request->socialMediasCaption;
            $footer->bgColor = $request->bgColor;
            $footer->contactUsCaption = $request->contactUsCaption;
            $footer->email = $request->email;
            $footer->phone = $request->phone;
            $footer->findUsCaption = $request->findUsCaption;
            //$footer->termsAndConditions = $request->termsAndConditions;
            //$footer->termsAndConditionsCaption = $request->termsAndConditionsCaption;
            $footer->mapLink = $request->mapLink;
            $footer->copyrightCaption = $request->copyrightCaption;

            $footer->save();

            return response()->json([
                'status' => 200,
                'message' => 'Update successful!',
            ]);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Footer $footer)
    {
        //
    }
}
