<?php

namespace App\Services\Version_1\Student_Management;


use App\Models\Student;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Version_1\Utils\GetEmailFromToken;

class Create_Student
{
    public function handle(Request $request)
    {
        //check if a campus with the given url exists
        $campus = Campus::where('url', $campusURL)->first();

        if($campus == null){
            return response()->json([
                'status' => '404',
                'message' => 'Not Found'
            ]);
        }

        //security measure
        
        if($campus->isPublished == false){

            return response()->json([
                'status' => '401',
                'message' => 'Access Denied!'
            ]);

        }

        $student = new Student();
            
        $student->campusID = $campus->campusID;

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
            'message' => 'Registration successful!',
        ],);

        
    }
}