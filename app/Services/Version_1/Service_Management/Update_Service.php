<?php

namespace App\Services\Version_1\Service_Management;


use App\Models\Service;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Update_Service
{
    public function handle(Request $request)
    {
        //campus admin authorization

        // first, get the user
        $user = User::where('email', $request->session()->get('userEmail'))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $request->campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ],);
        }
            
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
}