<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Auth;

class UserLogout
{
    public function handle(Request $request)
    {

        //decline request if token is not provided or null
        if(empty($request->token)){
            return response()->json([
                'status' => 403,
                'message' => "Token not provided! Please provide a token in your request.",
            ]);
        }

        //check the existence of the token
        $resultSet = DB::select('select * from auths where token = ?', [$request->token]);
        if(empty($resultSet)){        
            return response()->json([
                'status' => 403,
                'message' => 'Invalid Token!' 
            ]);
        } else{
            //delete the token
            DB::delete('delete from auths where token = ?', [$request->token]);

            return response()->json([
                'status' => 200,
                'message' => 'Logout successful!' 
            ]);
        }


    }
}