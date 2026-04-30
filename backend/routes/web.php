<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/debug-user', function (\Illuminate\Http\Request $request) {
    return [
        'user' => $request->user(),
        'auth_check' => auth()->check(),
        'session_id' => session()->getId(),
    ];
});

Route::get('/', function () {
    return response()->json([
        'app' => 'AutoPlac API',
        'version' => app()->version(),
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

require __DIR__.'/auth.php';
