<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class PasswordReset
{
    public function handle(Request $request)
    {
        //method called when password is reset

        $newPassword = $request->input('newPassword');
        $confirmPassword = $request->input('confirmPassword');        

        if (Cache::has($request->resetKey)) {
            //retierieve and delete data from cache
            $email = Cache::pull($request->resetKey);

            if($newPassword == $confirmPassword){
                DB::update('update users set password = ? where email = ?', [$newPassword, $email]);            

                return response()->json([
                    'status' => 200,
                    'message' => 'Password is successfully reset!' 
                ]);
            }
            else{
                return response()->json([
                    'status' => 422,
                    'message' => 'Passwords do not match!' 
                ]);
            }

        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'URL expired or does not exist!',
            ]);
        }
    }
}