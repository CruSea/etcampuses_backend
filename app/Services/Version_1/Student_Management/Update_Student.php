<?php

namespace App\Services\Version_1\Student_Management;


use App\Models\Student;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Version_1\Utils\GetEmailFromToken;

class Update_Student
{
    public function handle(Request $request)
    {
        //campus admin authorization

        // first, get the user
        $user = User::where('email', GetEmailFromToken::getEmailFromToken($request->token))->first();

        //make sure the user has access to the provided campus
        $hasAcess = User_Role::where('userID', $user->id)->where('role', $request->campusID)->first();

        if($hasAcess == null){
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ],);
        }
            
        //get the student that needs to be updated
        $student = Student::where('id', $request->studentID)->first();

        //check if the result is empty
        if($student == null){
            return response()->json([
                'status' => 404,
                'message' => 'Student not found',
            ]);
        }            

        //update the student
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
            'message' => 'Student updated successfully',
        ],);

        
    }
}