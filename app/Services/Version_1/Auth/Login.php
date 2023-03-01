<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Login
{
    public function handle(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
            return response()->json([
                'status' => 200,
                'message' => 'Already Logged in!'
            ]);
        }

        $resultSet = DB::select('select * from users where email = ? and password = ?', [$request->email,$request->password]);
        if(empty($resultSet)){        
            return response()->json([
                'status' => 403,
                'message' => 'Incorrect email or password!' 
            ]);
        }
        else{
            //save session        
            $request->session()->put('userEmail', $request->email);

            return response()->json([
                'status' => 200,
                'message' => 'Authentication successful!' 
            ]);
        }
    }
}