<?php

use Safitech\Iot\Http\Controllers\IotData\IotDataController;
use Safitech\Iot\Http\Controllers\Topics\TopicController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(IotDataController::class)->group(function () {
        Route::post('iot-data', 'store');
        Route::get('iot-data/{topic}', 'query');
    });

    Route::apiResource('topics', TopicController::class);
});
