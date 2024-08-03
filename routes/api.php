<?php

use App\Http\Controllers\LogController;
use App\Jobs\SendSms;
use Illuminate\Support\Facades\Route;

// Include pharmacy routes
include_once __DIR__ . '/v1/pharmacy_routes.php';
// Include pharmacy routes
include_once __DIR__ . '/v1/delivery_routes.php';

// Include delivery man routes
include_once __DIR__ . '/v1/admin_routes.php';

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group(['prefix'=>"media/"],function (){
    Route::post('',\App\Http\Controllers\Media\StoreController::class);
    Route::delete('{id}',\App\Http\Controllers\Media\DestroyController::class);
});
Route::get('region',\App\Http\Controllers\V1\Region\IndexController::class);
Route::get('city',\App\Http\Controllers\V1\City\IndexController::class);

Route::get('log',[LogController::class,'getLogs']);
Route::get('emptyLog',[LogController::class,'emptyLog']);



Route::get('test',function (){
    SendSms::dispatch('0945404066','1111');
});
