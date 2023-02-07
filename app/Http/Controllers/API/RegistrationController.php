<?php

namespace App\Http\Controllers\API;

use App\Models\Registration;
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
    public function update(Request $request, Registration $registration)
    {
        //
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
