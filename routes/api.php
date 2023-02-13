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
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
