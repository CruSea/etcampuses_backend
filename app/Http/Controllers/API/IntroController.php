<?php

namespace App\Http\Controllers\API;

use App\Models\Intro;
use App\Models\CampusAdmin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntroController extends Controller
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
        $intro = new Intro();
        $intro->campusID = $id;
        $intro->title = 'Welcome Message';
        $intro->message = 'Put your welcome message here';
        $intro->author = 'Author Name';
        $intro->authorPosition = 'Author Position';
        $intro->image = '';
        $intro->save();
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
     * @param  \App\Models\Intro  $intro
     * @return \Illuminate\Http\Response
     */
    public function show(Intro $intro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Intro  $intro
     * @return \Illuminate\Http\Response
     */
    public function edit(Intro $intro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Intro  $intro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the intro that belongs to the campus admin
            $intro = Intro::where('campusID', $campusAdmin->campusID)->first();

            //check if file is uploaded
            if ($request->hasFile('image')) {
                //image validation
                $validated = $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                //delete the old image
                Storage::delete($intro->image);

                $path = $request->image->storePublicly('intro','public');
                $intro->image = $path;
            }

            $intro->title = $request->title;
            $intro->message = $request->message;
            $intro->author = $request->author;
            $intro->authorPosition = $request->authorPosition;

            $intro->save();

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
     * @param  \App\Models\Intro  $intro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intro $intro)
    {
        //
    }
}
