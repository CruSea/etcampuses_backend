<?php

namespace App\Http\Controllers\API;

use App\Models\Registration;
use App\Models\CampusAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
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
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        // ONLY TITLE, DECRIPTION, BGCOLOR AND BUTTTON NAME ARE UPDATED FOR NOW

        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the registration that belongs to the campus admin
            $registration = Registration::where('campusID', $campusAdmin->campusID)->first();
            
            // some of the fields are not updated for now
            $registration->title = $request->title;
            $registration->description = $request->description;
            //$registration->firstNameCaption = $request->firstNameCaption;
            //$registration->lastNameCaption = $request->lastNameCaption;
            //$registration->cityCaption = $request->cityCaption;
            //$registration->languageCaption = $request->languageCaption;
            //$registration->sexCaption = $request->sexCaption;
            //$registration->maleCaption = $request->maleCaption;
            //$registration->femaleCaption = $request->femaleCaption;
            //$registration->phoneNumberCaption = $request->phoneNumberCaption;
            //$registration->isHostAvailableCaption = $request->isHostAvailableCaption;
            //$registration->yesCaption = $request->yesCaption;
            //$registration->noCaption =  $request->noCaption;
            $registration->buttonName = $request->buttonName;
            $registration->bgColor = $request->bgColor;

            $registration->save();

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
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        //
    }
}
