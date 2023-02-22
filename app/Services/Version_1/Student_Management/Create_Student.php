<?php

namespace App\Services\Version_1\Student_Management;


use App\Models\Student;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Create_Student
{
    public function handle(Request $request)
    {
        //campus admin authorization

        // first, get the user
        $user = User::where('email', $request->session()->get('userEmail'))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $request->campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ],);
        }

        $student = new Student();
            
        $student->campusID = $request->campusID;

        $student->firstName = $request->firstName;
        $student->lastName = $request->lastName;
        $student->city = $request->city;
        $student->language = $request->language;
        $student->sex = $request->sex;
        $student->phone = $request->phone;
        $student->church = $request->church;
        $student->isHostAvailable = $request->isHostAvailable;           
                            
        $student->save();

        return response()->json([
            'status' => 200,
            'message' => 'Student created successfully',
        ],);

        
    }
}