<?php

namespace App\Http\Controllers\API;

use App\Models\Campus;
use App\Models\CampusAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

            //Make sure this user is super-admin /////////////////////////////////////////////////

            $campus = new Campus();
            $campus->services_Title = 'Regular Programs';
            $campus->teams_Title = 'Teams waiting you';
            $campus->teams_Description = '<General description about your teams>';
            $campus->leaders_Title = 'Our Leaders';
            $campus->leaders_BgColor = 'rgba(3, 163, 245, 0.09)';
            $campus->gallery_Title = 'Gallery';
            $campus->save();

            //create welcome instance
            $welcome = new WelcomeController();
            $welcome->create($campus->id);

            //create intro instance
            $intro = new IntroController();
            $intro->create($campus->id);

            //create city instance
            $city = new CityController();
            $city->create($campus->id);

            //create about instance
            $about = new AboutController();
            $about->create($campus->id);

            //create fellowship instance
            $fellowship = new FellowshipController();
            $fellowship->create($campus->id);

            //create registration instance
            $registration = new RegistrationController();
            $registration->create($campus->id);

            //create footer instance
            $footer = new FooterController();
            $footer->create($campus->id);

            //create social instance
            $social = new SocialController();
            $social->create($campus->id);


            //Generate a unique password
            $password = uniqid();

            //create leader for the campus
            $campusAdmin = new CampusAdminController();
            $campusAdmin->create(
                $request->firstName,
                $request->lastName,
                $request->email,
                $password,
                $request->phone,            
                $campus->id,
                'NULL'
            );


            return response()->json([
                'status' => 200,
                'message' => 'Campus Created Successfully!',
                'New Campus Leader email' => $request->email,
                'New Campus Leader password' => $password
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

    public function update_Gallery_Title(Request $request){
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the campus that belongs to the campus admin
            $campus = Campus::where('id', $campusAdmin->campusID)->first();

            $campus->gallery_Title = $request->gallery_Title;            

            $campus->save();

            return response()->json([
                'status' => 200,
                'message' => 'Gallery title updated successfully!',
            ]);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    public function update_Services_Title(Request $request){
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the campus that belongs to the campus admin
            $campus = Campus::where('id', $campusAdmin->campusID)->first();

            $campus->services_Title = $request->services_Title;            

            $campus->save();

            return response()->json([
                'status' => 200,
                'message' => 'Services title updated successfully!',
            ]);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    public function update_Teams_Title(Request $request){
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the campus that belongs to the campus admin
            $campus = Campus::where('id', $campusAdmin->campusID)->first();

            $campus->teams_Title = $request->teams_Title;            

            $campus->save();

            return response()->json([
                'status' => 200,
                'message' => 'Teams title updated successfully!',
            ]);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    public function update_Teams_Description(Request $request){
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the campus that belongs to the campus admin
            $campus = Campus::where('id', $campusAdmin->campusID)->first();

            $campus->teams_Description = $request->teams_Description;            

            $campus->save();

            return response()->json([
                'status' => 200,
                'message' => 'Teams description updated successfully!',
            ]);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    public function update_Leaders_Title(Request $request){
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the campus that belongs to the campus admin
            $campus = Campus::where('id', $campusAdmin->campusID)->first();

            $campus->leaders_Title = $request->leaders_Title;            

            $campus->save();

            return response()->json([
                'status' => 200,
                'message' => 'Leaders title updated successfully!',
            ]);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    public function update_Leaders_BgColor(Request $request){
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
        
            //first, get the campus admin
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();
            
            //fetch the campus that belongs to the campus admin
            $campus = Campus::where('id', $campusAdmin->campusID)->first();

            $campus->leaders_BgColor = $request->leaders_BgColor;            

            $campus->save();

            return response()->json([
                'status' => 200,
                'message' => 'Leaders background color updated successfully!',
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
