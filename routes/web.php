<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\API\Version_1\Update_Campus\StudentController;
use Illuminate\Http\Request;
use App\Services\Version_1\Student_Management\Create_Student;
use App\Http\Controllers\API\Version_1\View_Campus\ViewCampusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/{campusURL}', function (ViewCampusController $viewCampusController, String $campusURL, Request $request) {
    return $viewCampusController->view_Campus($request, $campusURL);
});

Route::get('/{campusURL}/register', function (StudentController $studentController, String $campusURL, Request $request, Create_Student $createStudent) {
    return $studentController->create_Student($request, $createStudent, $campusURL);
});