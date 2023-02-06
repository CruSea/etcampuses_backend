<?php

namespace App\Http\Controllers\API;

use App\Models\Campus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\WelcomeController;

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
            $campus->services_Title = '';
            $campus->teams_Title = '';
            $campus->teams_Description = '';
            $campus->leaders_Title = '';
            $campus->leaders_BgColor = '';
            $campus->gallery_Title = '';
            $campus->save();

            //create welcome instance
            $welcome = new WelcomeController();
            $welcome->create($campus->id);

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
