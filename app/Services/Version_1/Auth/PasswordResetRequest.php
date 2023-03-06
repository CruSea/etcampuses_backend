<?php

namespace App\Services\Version_1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Notifications\PasswordReset2;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset;

class PasswordResetRequest
{
    public function handle(Request $request)
    {
        //method called when user requests password reset

        //check if email exists in users table
        $resultSet = DB::scalar('select email from users where email = ?', [$request->input('email')]);
        if(empty($resultSet)){
            return response()->json([
                'status' => 404,
                'message' => 'Email does not exist!',
            ]);
        }
        

        $resetKey = (string) Str::uuid();

        //save to cache
        Cache::put($resetKey, $request->input('email'), $seconds = 900); //900 seconds = 15 minutes

        //send email
        //get model first
        $user = User::where('email', $request->input('email'))->first();

        //old way
        //$user->notify(new PasswordReset2($user, $resetKey));

        Mail::to($user)->send(new PasswordReset($user, $resetKey));

        return response()->json([
            'status' => 200,
            'message' => 'Password Reset Requested Successfully!' 
        ]);
    }
}