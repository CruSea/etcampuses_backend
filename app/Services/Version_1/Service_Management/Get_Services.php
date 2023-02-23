<?php

namespace App\Services\Version_1\Service_Management;


use App\Models\Service;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Get_Services
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
            
        //get all services for the campus
        $services = Service::where('campusID', $request->campusID)->get();

            
        return response()->json([
            'status' => 200,
            'services' => $services,
        ],);

        
    }
}