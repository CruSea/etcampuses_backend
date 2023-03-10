<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAuthenticate
{
    public function handle(Request $request) //To check if users are logged in; used for middleware
    {
        //decline request if token is not provided
        if(empty($request->token)){
            return -1;
        }

        //check if the token exists
        $resultSet = DB::select('select * from auths where token = ?', [$request->token]);
        if(!empty($resultSet)){   

            return 1;

        }

        else{

            //invalid token
            return 0;

        }
    }
}