<?php

namespace App\Http\Controllers\API\Version_1\Update_Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Version_1\Student_Management\Create_Student;
use App\Services\Version_1\Student_Management\Get_Students;
use App\Services\Version_1\Student_Management\Update_Student;
use App\Services\Version_1\Student_Management\Delete_Student;


class StudentController extends Controller
{
    public function create_Student(Request $request, Create_Student $createStudent)
    {
        return $createStudent->handle($request);
    }

    public function get_Students(Request $request, Get_Students $getStudents)
    {
        return $getStudents->handle($request);
    }

    public function update_Student(Request $request, Update_Student $updateStudent)
    {
        return $updateStudent->handle($request);
    }

    public function delete_Student(Request $request, Delete_Student $deleteStudent)
    {
        return $deleteStudent->handle($request);
    }
}