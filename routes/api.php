<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CampusAdminController;
use App\Http\Controllers\API\PasswordResetController;
use App\Http\Controllers\API\GalleryController;
use App\Http\Controllers\API\CampusController;

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

Route::post('/add-campus-admin', [CampusAdminController::Class, 'store']); // implicit, temporary

Route::post('/reset-password-request', [PasswordResetController::Class, 'store']); // to request password reset
Route::post('/reset-password', [PasswordResetController::Class, 'update']); // to reset password after link is clicked

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', [CampusAdminController::Class, 'authenticate']);
    Route::get('/logout', [CampusAdminController::Class, 'logOut']);
    Route::get('/changepassword',[CampusAdminController::Class, 'changePassword']);

    Route::post('/upload-gallery-image', [GalleryController::Class, 'store']);
    Route::post('/create-campus', [CampusController::Class, 'create']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
