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

Route::post('/reset-password-request', [PasswordResetController::Class, 'store']); // to request password reset
Route::post('/reset-password', [PasswordResetController::Class, 'update']); // to reset password after link is clicked

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', [CampusAdminController::Class, 'authenticate']);
    Route::get('/logout', [CampusAdminController::Class, 'logOut']);
    Route::post('/changepassword',[CampusAdminController::Class, 'changePassword']);

    Route::post('/upload-gallery-image', [GalleryController::Class, 'store']);
    Route::delete('/delete-gallery-image', [GalleryController::Class, 'destroy']);

    Route::post('/create-campus', [CampusController::Class, 'create']);

    Route::post('/update-welcome', [WelcomeController::Class, 'update']);
    Route::post('/update-intro', [IntroController::Class, 'update']);
    Route::post('/update-city', [CityController::Class, 'update']);
    Route::post('/update-about', [AboutController::Class, 'update']);
    Route::post('/update-fellowship', [FellowshipController::Class, 'update']);
    Route::post('/update-registration', [RegistrationController::Class, 'update']);
    Route::post('/update-footer', [FooterController::Class, 'update']);
    Route::post('/update-social', [SocialController::Class, 'update']);

    // APIs to edit captions
    // May be temporary or part of other routes
    // For now, they are included in the campus controller, because the fields belong to the campus model    
    Route::post('/update-services-title', [CampusController::Class, 'update_Services_Title']);
    Route::post('/update-teams-title', [CampusController::Class, 'update_Teams_Title']);
    Route::post('/update-teams-description', [CampusController::Class, 'update_Teams_Description']);
    Route::post('/update-leaders-title', [CampusController::Class, 'update_Leaders_Title']);
    Route::post('/update-leaders-bgcolor', [CampusController::Class, 'update_Leaders_BgColor']);
    Route::post('/update-gallery-title', [CampusController::Class, 'update_Gallery_Title']);

    Route::post('/create-service', [ServiceController::Class, 'store']);
    Route::get('/get-services', [ServiceController::Class, 'show']);
    Route::post('/update-service', [ServiceController::Class, 'update']);
    Route::delete('/delete-service', [ServiceController::Class, 'destroy']);

    Route::post('/create-leader', [LeaderController::Class, 'store']);
    Route::get('/get-leaders', [LeaderController::Class, 'show']);
    Route::post('/update-leader', [LeaderController::Class, 'update']);
    Route::delete('/delete-leader', [LeaderController::Class, 'destroy']);

    Route::post('/create-team', [TeamController::Class, 'store']);
    Route::get('/get-teams', [TeamController::Class, 'show']);
    Route::post('/update-team', [TeamController::Class, 'update']);
    Route::delete('/delete-team', [TeamController::Class, 'destroy']);
    
    Route::post('/create-student', [StudentController::Class, 'store']); //Creating students shouldn't be authenticated
    Route::get('/get-students', [StudentController::Class, 'show']);
    Route::post('/update-student', [StudentController::Class, 'update']);
    Route::delete('/delete-student', [StudentController::Class, 'destroy']);

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
