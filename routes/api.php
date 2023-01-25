<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CampusAdminController;

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

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', [CampusAdminController::Class, 'authenticate']);
    Route::get('/logout', [CampusAdminController::Class, 'logOut']);
    Route::get('/changepassword',[CampusAdminController::Class, 'changePassword']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
