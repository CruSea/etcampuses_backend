<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Auth;

class UserLogin
{
    public function handle(Request $request)
    {
        //delete previous token if exists - security measure - logs the user out even if the credentials are incorrect
        //access it via email
        $resultSet = DB::select('select * from auths where email = ?', [$request->email]);
        if(!empty($resultSet)){        
            DB::delete('delete from auths where email = ?', [$request->email]);
        }

        //check if login credentials are correct

        $resultSet = DB::select('select * from users where email = ? and password = ?', [$request->email,$request->password]);
        if(empty($resultSet)){        
            return response()->json([
                'status' => 403,
                'message' => 'Incorrect email or password!' 
            ]);
        }

        // add the user to the auths table
        $auths = new Auth();

        //generate new token
        $token1 = (string) Str::uuid();
        $token2 = (string) Str::uuid();

        $auths->token = $token1 . $token2;

        $auths->email = $request->email;

        $auths->save();

        return response()->json([
            'status' => 200,
            'message' => 'Authentication successful!',
            'token' => $auths->token
        ]);


    }
}