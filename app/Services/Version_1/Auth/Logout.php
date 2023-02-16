<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Logout
{
    public function handle(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
            
            $email = $request->session()->pull('userEmail', 'null');

            return response()->json([
                'status' => 200,
                'message' => 'Log out successful!'                
            ]);

        }
        else{

            return response()->json([
                'status' => 200,
                'message' => 'Not Logged in!'
            ]);

        }
    }
}