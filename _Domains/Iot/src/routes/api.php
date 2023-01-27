<?php

use Illuminate\Support\Facades\Route;
use Safitech\Iot\Http\Controllers\Messages\MessageController;
use Safitech\Iot\Http\Controllers\Messages\MessageQueryController;
use Safitech\Iot\Http\Controllers\Topics\TopicController;

Route::middleware('auth:sanctum')
    ->prefix('/iot')
    ->group(function () {
        Route::apiResource('topics', TopicController::class);

        Route::apiResource('messages', MessageController::class)->only('store');

        Route::controller(MessageQueryController::class)->group(function () {
            Route::get('iot-data/{topic}', 'query');
            Route::get('iot-data', 'all');
        });
    });
