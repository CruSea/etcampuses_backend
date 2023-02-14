<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use App\Models\CampusAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {
            
            $student = new Student();

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            $student->campusID = $campusAdmin->campusID;

            $student->firstName = $request->firstName;
            $student->lastName = $request->lastName;
            $student->city = $request->city;
            $student->language = $request->language;
            $student->sex = $request->sex;
            $student->phone = $request->phone;
            $student->isHostAvailable = $request->isHostAvailable;           
                                
            $student->save();

            return response()->json([
                'status' => 200,
                'message' => 'Student created successfully',
            ],);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student, Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            //get all students of the campus
            $students = Student::where('campusID', $campusAdmin->campusID)->get();

            
            return response()->json([
                'status' => 200,
                'students' => $students,
            ],);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

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
            $student->isHostAvailable = $request->isHostAvailable;                       

            $student->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Student updated successfully',
            ],);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student, Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {            

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

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
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }
}
