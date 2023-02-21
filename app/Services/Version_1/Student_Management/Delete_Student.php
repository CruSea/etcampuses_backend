<?php

namespace App\Services\Version_1\Student_Management;


use App\Models\Student;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Delete_Student
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
            
        //get the student that needs to be deleted
        $student = Student::where('id', $request->studentID)->first();

        //check if the result is empty
        if($student == null){
            return response()->json([
                'status' => 404,
                'message' => 'Student not found',
            ]);
        }            

        //delete the Team
        $student->delete();
        
        return response()->json([
            'status' => 200,
            'message' => 'Student deleted successfully',
        ],);

        
    }
}