<?php

namespace App\Services\Version_1\Admin_Management;

use Illuminate\Http\Request;
use App\Models\User;


class Create_Admin
{
    public function handle(Request $request)
    {
        //Used for campus admin signups!

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