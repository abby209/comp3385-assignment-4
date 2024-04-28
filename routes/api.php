<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:api')->group(function () {
    // Protected routes
    Route::get('/api/v1/movies', [MovieController::class, 'index']);
    Route::post('/api/v1/movies', [MovieController::class, 'store']);
});