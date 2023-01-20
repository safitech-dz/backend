<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IotData\IotDataController;
use App\Http\Controllers\Topics\TopicController;
use Illuminate\Support\Facades\Route;

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

Route::post('login', LoginController::class)->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(IotDataController::class)->group(function () {
        Route::post('iot-data', 'store');
        Route::get('iot-data/{topic}', 'query');
    });

    Route::apiResource('topics', TopicController::class);
});
