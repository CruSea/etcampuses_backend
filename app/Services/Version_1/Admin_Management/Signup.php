<?php

namespace App\Services\Version_1\Admin_Management;

use Illuminate\Http\Request;
use App\Models\User;

header('Access-Control-Allow-Origin: *');

class Signup
{
    public function handle(Request $request)
    {
        //Used for campus admin signups!

        echo "Datas you sent to the server";

        return response()->json([
            'first name' => $request->firstName,
            'last name' => $request->lastName,
            'email' => $request->email,
            'password' => $request->password,
            'confirm password' => $request->confirmPassword,
        ]);

        //check if passwords match
        if($request->password != $request->confirmPassword){
            return response()->json([
                'status' => 403,
                'message' => 'Passwords do not match!',
            ]);
        }

        $user = new User();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->promotedBy = 0; //Just for placeholder, modified below
        $user->profilePicture = '';
        $user->theme = 'light';

        $user->status = 'active';
        $user->lastActivityTimestamp = '';
        $user->lastUsedDevice = '';

        $user->save();

        //signed up users are promoted by themselves
        $user->promotedBy = $user->id;
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Sign Up Successful!',
        ]);
    }
}