<?php

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\CarImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/cars', CarController::class)->only(['index', 'show']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/cars', CarController::class)->except(['index', 'show']);

    Route::post('/cars/{car}/images', [CarImageController::class,'store']);

    Route::delete('/cars/{car}/images/{image}', [CarImageController::class,'destroy']);
});

require __DIR__.'/auth.php';