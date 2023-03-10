<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Version_1\Update_Campus\GalleryController;
use App\Http\Controllers\API\Version_1\Update_Campus\UpdateCampusCaptionsController;
use App\Http\Controllers\API\Version_1\Update_Campus\ServiceController;
use App\Http\Controllers\API\Version_1\Update_Campus\LeaderController;
use App\Http\Controllers\API\Version_1\Update_Campus\TeamController;
use App\Http\Controllers\API\Version_1\Update_Campus\StudentController;
use App\Http\Controllers\API\Version_1\Auth\AuthController;
use App\Http\Controllers\API\Version_1\Auth\AuthController2;
use App\Http\Controllers\API\Version_1\Create_Campus\SignupController;
use App\Http\Controllers\API\Version_1\Create_Campus\CreateNewCampusController;
use App\Http\Controllers\API\Version_1\Update_Campus\UpdateCampusContentController;
use App\Http\Controllers\API\Version_1\View_Campus\ViewCampusController;
use App\Http\Controllers\API\Version_1\Admin_Management\AdminManagementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::post('/add-campus-admin', [CampusAdminController::Class, 'store']); // implicit, temporary

Route::post('/reset-password-request', [AuthController::Class, 'passwordResetRequest']); // to request password reset
Route::post('/reset-password', [AuthController::Class, 'passwordReset']); // to reset password after link is clicked
Route::post('/signup', [SignupController::Class, 'signup']);


Route::group(['middleware' => ['web']], function () { // routes that require session must be placed here

    //old login and logout apis are commented, but not deleted
    //Route::post('/login', [AuthController::Class, 'login']);
    //Route::get('/logout', [AuthController::Class, 'logout']);

    //new login and logout apis are created
    Route::post('/login', [AuthController2::Class, 'login']);
    Route::get('/logout', [AuthController2::Class, 'logout']);
    
    Route::post('/changepassword',[AuthController::Class, 'changePassword'])->middleware('user.auth.2');

    Route::post('/create-new-campus', [CreateNewCampusController::Class, 'create_New_Campus'])->middleware('user.auth.2');

    Route::get('/get-admins', [AdminManagementController::Class, 'get_Admins'])->middleware('user.auth.2');

    Route::post('/upload-gallery-image', [GalleryController::Class, 'upload'])->middleware('user.auth.2');
    Route::post('/upload-gallery-images', [GalleryController::Class, 'upload_Multiple'])->middleware('user.auth.2');
    Route::delete('/delete-gallery-image', [GalleryController::Class, 'delete'])->middleware('user.auth.2');
    Route::delete('/delete-gallery-images', [GalleryController::Class, 'deleteMultiple'])->middleware('user.auth.2');

    Route::post('/update-welcome', [UpdateCampusContentController::Class, 'update_Welcome_Section'])->middleware('user.auth.2');
    Route::post('/update-intro', [UpdateCampusContentController::Class, 'update_Intro_Section'])->middleware('user.auth.2');
    Route::post('/update-city', [UpdateCampusContentController::Class, 'update_City_Section'])->middleware('user.auth.2');
    Route::post('/update-about', [UpdateCampusContentController::Class, 'update_About_Section'])->middleware('user.auth.2');
    Route::post('/update-fellowship', [UpdateCampusContentController::Class, 'update_Fellowship_Section'])->middleware('user.auth.2');
    //Registration is not allowed to be updated
    //Route::post('/update-registration', [UpdateCampusContentController::Class, 'update_Registration_Section'])->middleware('user.auth.2');
    Route::post('/update-footer', [UpdateCampusContentController::Class, 'update_Footer_Section'])->middleware('user.auth.2');
    //update social api is merged into update footer api
    //this is just additional api
    Route::post('/update-social', [UpdateCampusContentController::Class, 'update_Social_Section'])->middleware('user.auth.2');

    // APIs to edit captions
    // May be temporary or part of other routes
    // These Routes are hidden for now
    /*
    Route::post('/update-services-title', [UpdateCampusCaptionsController::Class, 'update_Services_Title'])->middleware('user.auth.2');
    Route::post('/update-teams-title', [UpdateCampusCaptionsController::Class, 'update_Teams_Title'])->middleware('user.auth.2');
    Route::post('/update-teams-description', [UpdateCampusCaptionsController::Class, 'update_Teams_Description'])->middleware('user.auth.2');
    Route::post('/update-leaders-title', [UpdateCampusCaptionsController::Class, 'update_Leaders_Title'])->middleware('user.auth.2');
    Route::post('/update-leaders-bgcolor', [UpdateCampusCaptionsController::Class, 'update_Leaders_BgColor'])->middleware('user.auth.2');
    Route::post('/update-gallery-title', [UpdateCampusCaptionsController::Class, 'update_Gallery_Title'])->middleware('user.auth.2');
    */

    Route::post('/create-service', [ServiceController::Class, 'create_Service'])->middleware('user.auth.2');
    Route::get('/get-services', [ServiceController::Class, 'get_Services'])->middleware('user.auth.2');
    Route::post('/update-service', [ServiceController::Class, 'update_Service'])->middleware('user.auth.2');
    Route::delete('/delete-service', [ServiceController::Class, 'delete_Service'])->middleware('user.auth.2');

    Route::post('/create-leader', [LeaderController::Class, 'create_Leader'])->middleware('user.auth.2');
    Route::get('/get-leaders', [LeaderController::Class, 'get_Leaders'])->middleware('user.auth.2');
    Route::post('/update-leader', [LeaderController::Class, 'update_Leader'])->middleware('user.auth.2');
    Route::delete('/delete-leader', [LeaderController::Class, 'delete_Leader'])->middleware('user.auth.2');

    Route::post('/create-team', [TeamController::Class, 'create_Team'])->middleware('user.auth.2');
    Route::get('/get-teams', [TeamController::Class, 'get_Teams'])->middleware('user.auth.2');
    Route::post('/update-team', [TeamController::Class, 'update_Team'])->middleware('user.auth.2');
    Route::delete('/delete-team', [TeamController::Class, 'delete_Team'])->middleware('user.auth.2');
    
    Route::post('/create-student', [StudentController::Class, 'create_Student']); //Creating students shouldn't be authenticated
    Route::get('/get-students', [StudentController::Class, 'get_Students'])->middleware('user.auth.2');
    Route::post('/update-student', [StudentController::Class, 'update_Student'])->middleware('user.auth.2');
    Route::delete('/delete-student', [StudentController::Class, 'delete_Student'])->middleware('user.auth.2');

    Route::get('/{campusURL}', function (ViewCampusController $viewCampusController, String $campusURL, Request $request) {
        return $viewCampusController->view_Campus($request, $campusURL);
    });

});
