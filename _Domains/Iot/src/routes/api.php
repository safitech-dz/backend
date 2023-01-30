<?php

use Illuminate\Support\Facades\Route;
use Safitech\Iot\Http\Controllers\Messages\MessageController;
use Safitech\Iot\Http\Controllers\Messages\MessageQueryController;
use Safitech\Iot\Http\Controllers\Topics\TopicController;

Route::middleware('auth:sanctum')
    ->prefix('/iot')
    ->group(function () {
        Route::apiResource('topics', TopicController::class);

        Route::prefix('messages')
            ->group(function () {
                Route::post('', [MessageController::class, 'store'])
                    // TODO: GUARD -> only aggregator
                    ->withoutMiddleware("throttle:api");

                Route::get('query', MessageQueryController::class);
            });
    });
