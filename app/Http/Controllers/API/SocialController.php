<?php

namespace App\Http\Controllers\API;

use App\Models\Social;
use App\Models\CampusAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialController extends Controller
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
        $social = new Social();
        $social->campusID = $id;
        $social->facebookLink = '<Your Facebook Link>';
        $social->telegramLink = '<Your Telegram Link>';
        $social->instagramLink = '<Your Instagram Link>';
        $social->youtubeLink = '<Your Youtube Link>';
        $social->tiktokLink = '<Your Tiktok Link>';
        $social->save();
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
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the social that belongs to the campus admin
            $social = Social::where('campusID', $campusAdmin->campusID)->first();
            
            $social->facebookLink = $request->facebookLink;
            $social->telegramLink = $request->telegramLink;
            $social->instagramLink = $request->instagramLink;
            $social->youtubeLink = $request->youtubeLink;
            $social->tiktokLink = $request->tiktokLink;

            $social->save();

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
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social)
    {
        //
    }
}
