<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CampusAdmin;

class CityController extends Controller
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
        $city = new City();
        $city->campusID = $id;
        $city->title = 'Our City';
        $city->description = 'Say something about your city';
        $city->name = 'Your City Name';
        $city->save();
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
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the City that belongs to the campus admin
            $city = City::where('campusID', $campusAdmin->campusID)->first();

            $city->title = $request->title;
            $city->description = $request->description;
            $city->name = $request->name;

            $city->save();

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
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
