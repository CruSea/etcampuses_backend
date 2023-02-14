<?php

namespace App\Http\Controllers\API;

use App\Models\Team;
use App\Models\CampusAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $team = new Team();

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            $team->campusID = $campusAdmin->campusID;

            $path = $request->image->storePublicly('teams','public');
            $team->image = $path;

            $team->name = $request->name;
            $team->description = $request->description;            
                                
            $team->save();

            return response()->json([
                'status' => 200,
                'message' => 'Team created successfully',
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
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team, Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            //get all teams for the campus
            $teams = Team::where('campusID', $campusAdmin->campusID)->get();

            
            return response()->json([
                'status' => 200,
                'teams' => $teams,
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
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            //get the team that needs to be updated
            $team = Team::where('id', $request->teamID)->first();

            //check if the result is empty
            if($team == null){
                return response()->json([
                    'status' => 404,
                    'message' => 'Team not found',
                ]);
            }

            //check if image is uploaded
            if ($request->hasFile('image')) {
                //image validation
                $validated = $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                //delete the old image if it exists
                if($team->image != ''){
                    Storage::delete($team->image);
                }                

                $path = $request->image->storePublicly('teams','public');
                $team->image = $path;
            }

            //update the service
            $team->name = $request->name;
            $team->description = $request->description;                        

            $team->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Team updated successfully',
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
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team, Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            //get the team that needs to be deleted
            $team = Team::where('id', $request->teamID)->first();

            //check if the result is empty
            if($team == null){
                return response()->json([
                    'status' => 404,
                    'message' => 'Team not found',
                ]);
            }

            //delete the image if it exists
            if($team->image != ''){
                Storage::delete($team->image);
            }

            //delete the Team
            $team->delete();
            
            return response()->json([
                'status' => 200,
                'message' => 'Team deleted successfully',
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
