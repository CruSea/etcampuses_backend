<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CampusAdminController;
use App\Http\Controllers\API\PasswordResetController;
use App\Http\Controllers\API\GalleryController;
use App\Http\Controllers\API\CampusController;
use App\Http\Controllers\API\WelcomeController;
use App\Http\Controllers\API\IntroController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\FellowshipController;
use App\Http\Controllers\API\RegistrationController;
use App\Http\Controllers\API\FooterController;
use App\Http\Controllers\API\SocialController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\LeaderController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\Version_1\Auth\AuthController;

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

Route::group(['middleware' => ['web']], function () { // routes that require session must be placed here
    Route::get('/login', [AuthController::Class, 'login']);
    Route::get('/logout', [AuthController::Class, 'logout']);
    Route::post('/changepassword',[AuthController::Class, 'changePassword'])->middleware('user.auth');

    Route::post('/upload-gallery-image', [GalleryController::Class, 'store'])->middleware('user.auth');
    Route::delete('/delete-gallery-image', [GalleryController::Class, 'destroy'])->middleware('user.auth');

    Route::post('/create-campus', [CampusController::Class, 'create'])->middleware('user.auth');

    Route::post('/update-welcome', [WelcomeController::Class, 'update'])->middleware('user.auth');
    Route::post('/update-intro', [IntroController::Class, 'update'])->middleware('user.auth');
    Route::post('/update-city', [CityController::Class, 'update'])->middleware('user.auth');
    Route::post('/update-about', [AboutController::Class, 'update'])->middleware('user.auth');
    Route::post('/update-fellowship', [FellowshipController::Class, 'update'])->middleware('user.auth');
    Route::post('/update-registration', [RegistrationController::Class, 'update'])->middleware('user.auth');
    Route::post('/update-footer', [FooterController::Class, 'update'])->middleware('user.auth');
    Route::post('/update-social', [SocialController::Class, 'update'])->middleware('user.auth');

    // APIs to edit captions
    // May be temporary or part of other routes
    // For now, they are included in the campus controller, because the fields belong to the campus model    
    Route::post('/update-services-title', [CampusController::Class, 'update_Services_Title'])->middleware('user.auth');
    Route::post('/update-teams-title', [CampusController::Class, 'update_Teams_Title'])->middleware('user.auth');
    Route::post('/update-teams-description', [CampusController::Class, 'update_Teams_Description'])->middleware('user.auth');
    Route::post('/update-leaders-title', [CampusController::Class, 'update_Leaders_Title'])->middleware('user.auth');
    Route::post('/update-leaders-bgcolor', [CampusController::Class, 'update_Leaders_BgColor'])->middleware('user.auth');
    Route::post('/update-gallery-title', [CampusController::Class, 'update_Gallery_Title'])->middleware('user.auth');

    Route::post('/create-service', [ServiceController::Class, 'store'])->middleware('user.auth');
    Route::get('/get-services', [ServiceController::Class, 'show'])->middleware('user.auth');
    Route::post('/update-service', [ServiceController::Class, 'update'])->middleware('user.auth');
    Route::delete('/delete-service', [ServiceController::Class, 'destroy'])->middleware('user.auth');

    Route::post('/create-leader', [LeaderController::Class, 'store'])->middleware('user.auth');
    Route::get('/get-leaders', [LeaderController::Class, 'show'])->middleware('user.auth');
    Route::post('/update-leader', [LeaderController::Class, 'update'])->middleware('user.auth');
    Route::delete('/delete-leader', [LeaderController::Class, 'destroy'])->middleware('user.auth');

    Route::post('/create-team', [TeamController::Class, 'store'])->middleware('user.auth');
    Route::get('/get-teams', [TeamController::Class, 'show'])->middleware('user.auth');
    Route::post('/update-team', [TeamController::Class, 'update'])->middleware('user.auth');
    Route::delete('/delete-team', [TeamController::Class, 'destroy'])->middleware('user.auth');
    
    Route::post('/create-student', [StudentController::Class, 'store']); //Creating students shouldn't be authenticated
    Route::get('/get-students', [StudentController::Class, 'show'])->middleware('user.auth');
    Route::post('/update-student', [StudentController::Class, 'update'])->middleware('user.auth');
    Route::delete('/delete-student', [StudentController::Class, 'destroy'])->middleware('user.auth');

});
