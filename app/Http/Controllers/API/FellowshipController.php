<?php

namespace App\Http\Controllers\API;

use App\Models\Fellowship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FellowshipController extends Controller
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
     * @param  \App\Models\Fellowship  $fellowship
     * @return \Illuminate\Http\Response
     */
    public function show(Fellowship $fellowship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fellowship  $fellowship
     * @return \Illuminate\Http\Response
     */
    public function edit(Fellowship $fellowship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fellowship  $fellowship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fellowship $fellowship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fellowship  $fellowship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fellowship $fellowship)
    {
        //
    }
}
