<?php

namespace App\Services\Version_1\Service_Management;


use App\Models\Service;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Version_1\Utils\GetEmailFromToken;

class Delete_Service
{
    public function handle(Request $request)
    {
        //campus admin authorization

        // first, get the user
        $user = User::where('email', GetEmailFromToken::getEmailFromToken($request->token))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $request->campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ],);
        }
            
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
}