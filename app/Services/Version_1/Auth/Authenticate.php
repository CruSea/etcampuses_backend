<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Authenticate
{
    public function handle(Request $request) //To check if users are logged in
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
            
            return 1;

        }
        else{

            return 0;

        }
    }
}