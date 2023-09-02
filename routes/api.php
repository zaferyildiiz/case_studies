<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeviceInformationController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\AdminController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post("/login",[DeviceInformationController::class,"getDeviceInformation"])->name("getDeviceInformation");


Route::post("/subscription",[SubscriptionController::class,"subscription"]);

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin-panel', 'AdminController@index');
});