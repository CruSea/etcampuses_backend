<?php

namespace App\Http\Controllers\API;

use App\Models\Fellowship;
use App\Models\CampusAdmin;
use Illuminate\Support\Facades\Storage;
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
    public function update(Request $request)
    {
        // ONLY NUMERICAL VALUES OF THE FELLOWSHIP ARE UPDATED
        // CAPTIONS ARE NOT CURRENTLY UPDATED

        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the fellowship that belongs to the campus admin
            $fellowship = Fellowship::where('campusID', $campusAdmin->campusID)->first();

            //check if file is uploaded
            if ($request->hasFile('image')) {
                //image validation
                $validated = $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                //delete the old image if it exists
                if ($fellowship->image != '') {
                    Storage::delete($fellowship->image);
                }

                $path = $request->image->storePublicly('fellowship','public');
                $fellowship->image = $path;
            }

            $fellowship->title = $request->title;
            $fellowship->members = $request->members;
            //$fellowship->membersCaption = $request->membersCaption;   //not currently updated
            $fellowship->teams = $request->teams;
            //$fellowship->teamsCaption = $request->teamsCaption;    //not currently updated
            $fellowship->services = $request->services;
            //$fellowship->servicesCaption = $request->servicesCaption;    //not currently updated
            $fellowship->bgColor = $request->bgColor;

            $fellowship->save();

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
     * @param  \App\Models\Fellowship  $fellowship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fellowship $fellowship)
    {
        //
    }
}
