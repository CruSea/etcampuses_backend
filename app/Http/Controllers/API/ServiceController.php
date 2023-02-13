<?php

namespace App\Http\Controllers\API;

use App\Models\Service;
use App\Models\CampusAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
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

            $service = new Service();

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            $service->campusID = $campusAdmin->campusID;

            $service->name = $request->name;
            $service->day = $request->day;
            $service->time = $request->time;
            $service->address = $request->address;
                                
            $service->save();

            return response()->json([
                'status' => 200,
                'message' => 'Service created successfully',
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
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service, Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            //get all services for the campus
            $services = Service::where('campusID', $campusAdmin->campusID)->get();

            
            return response()->json([
                'status' => 200,
                'services' => $services,
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
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            //get the service that needs to be updated
            $service = Service::where('id', $request->serviceID)->first();

            //check if the result is empty
            if($service == null){
                return response()->json([
                    'status' => 404,
                    'message' => 'Service not found',
                ]);
            }

            //update the service
            $service->name = $request->name;
            $service->day = $request->day;
            $service->time = $request->time;
            $service->address = $request->address;

            $service->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Service updated successfully',
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
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            //get the service that needs to be deleted
            $service = Service::where('id', $request->serviceID)->first();

            //check if the result is empty
            if($service == null){
                return response()->json([
                    'status' => 404,
                    'message' => 'Service not found',
                ]);
            }

            //delete the service
            $service->delete();
            
            return response()->json([
                'status' => 200,
                'message' => 'Service deleted successfully',
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
