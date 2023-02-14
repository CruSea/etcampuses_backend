<?php

namespace App\Http\Controllers\API;

use App\Models\Leader;
use App\Models\CampusAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LeaderController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {

            //image validation
            $validated = $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $leader = new Leader();

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            $leader->campusID = $campusAdmin->campusID;

            $path = $request->photo->storePublicly('leaders','public');
            $leader->photo = $path;

            $leader->name = $request->name;
            $leader->role = $request->role;            
            $leader->phone = $request->phone;
            
            if($request->telegramLink != null)
                $leader->telegramLink = $request->telegramLink;
            else
                $leader->telegramLink = '';

            if($request->facebookLink != null)
                $leader->facebookLink = $request->facebookLink;
            else
                $leader->facebookLink = '';
                                
            $leader->save();

            return response()->json([
                'status' => 200,
                'message' => 'Leader created successfully',
            ],);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function show(Leader $leader, Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            //get all leaders for the campus
            $leaders = Leader::where('campusID', $campusAdmin->campusID)->get();

            
            return response()->json([
                'status' => 200,
                'leaders' => $leaders,
            ],);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function edit(Leader $leader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leader $leader)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            //get the leader that needs to be updated
            $leader = Leader::where('id', $request->leaderID)->first();

            //check if the result is empty
            if($leader == null){
                return response()->json([
                    'status' => 404,
                    'message' => 'Leader not found',
                ]);
            }

            //check if photo is uploaded
            if ($request->hasFile('photo')) {
                //image validation
                $validated = $request->validate([
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                //delete the old image if it exists
                if($leader->photo != ''){
                    Storage::delete($leader->photo);
                }                

                $path = $request->photo->storePublicly('leaders','public');
                $leader->photo = $path;
            }

            //update the service
            $leader->name = $request->name;
            $leader->role = $request->role;            
            $leader->phone = $request->phone;

            if($request->telegramLink != null)
                $leader->telegramLink = $request->telegramLink;
            else
                $leader->telegramLink = '';

            if($request->facebookLink != null)
                $leader->facebookLink = $request->facebookLink;
            else
                $leader->facebookLink = '';

            $leader->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Leader updated successfully',
            ],);

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
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leader $leader, Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            //get the leader that needs to be deleted
            $leader = Leader::where('id', $request->leaderID)->first();

            //check if the result is empty
            if($leader == null){
                return response()->json([
                    'status' => 404,
                    'message' => 'Leader not found',
                ]);
            }

            //delete the old image if it exists
            if($leader->photo != ''){
                Storage::delete($leader->photo);
            }

            //delete the service
            $leader->delete();
            
            return response()->json([
                'status' => 200,
                'message' => 'Leader deleted successfully',
            ],);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }
}
