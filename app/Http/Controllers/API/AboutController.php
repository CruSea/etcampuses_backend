<?php

namespace App\Http\Controllers\API;

use App\Models\About;
use App\Models\CampusAdmin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
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
        // $about = new About();
        // $about->campusID = $id;
        // $about->title = 'About Campus';
        // $about->description = 'Say something about your campus';
        // $about->logo = '';
        // $about->bgImage = '';
        // $about->save();
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
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the about that belongs to the campus admin
            $about = About::where('campusID', $campusAdmin->campusID)->first();

            //check if logo is uploaded
            if ($request->hasFile('logo')) {
                //image validation
                $validated = $request->validate([
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                //delete the old image if it exists
                if($about->logo != ''){
                    Storage::delete($about->logo);
                }                

                $path = $request->logo->storePublicly('about_logo','public');
                $about->logo = $path;
            }

            //check if background image is uploaded
            if ($request->hasFile('bgImage')) {
                //image validation
                $validated = $request->validate([
                    'bgImage' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                //delete the old image if it exists
                if($about->bgImage != ''){
                    Storage::delete($about->bgImage);
                }                

                $path = $request->bgImage->storePublicly('about_bgImage','public');
                $about->bgImage = $path;
            }



            $about->title = $request->title;
            $about->description = $request->description;

            $about->save();

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
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
