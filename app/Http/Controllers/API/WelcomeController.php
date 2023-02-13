<?php

namespace App\Http\Controllers\API;

use App\Models\Welcome;
use App\Models\CampusAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
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
        $welcome = new Welcome();
        $welcome->campusID = $id;
        $welcome->image = '';
        $welcome->title = 'Welcome to <Your City>';
        $welcome->campusName = '<Your Campus Name>';
        $welcome->moto = 'Put your campus moto here';
        $welcome->registerButtonText = 'Register Now';
        $welcome->save();
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
     * @param  \App\Models\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function show(Welcome $welcome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function edit(Welcome $welcome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {

        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the welcome that belongs to the campus admin
            $welcome = Welcome::where('campusID', $campusAdmin->campusID)->first();

            //check if file is uploaded
            if ($request->hasFile('image')) {
                //image validation
                $validated = $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                //delete the old image if it exists
                if($welcome->image != ''){
                    Storage::delete($welcome->image);
                }                

                $path = $request->image->storePublicly('welcome','public');
                $welcome->image = $path;
            }

            $welcome->title = $request->input('title');
            $welcome->campusName = $request->campusName;
            $welcome->moto = $request->moto;
            $welcome->registerButtonText = $request->registerButtonText;

            $welcome->save();

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
     * @param  \App\Models\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Welcome $welcome)
    {
        //
    }
}
