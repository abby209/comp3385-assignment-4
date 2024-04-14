<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/user', function (Request $request) {
    if ($request->user()) {
        return response()->json($request->user());
    } else {
      // Handle unauthenticated user case
        return response()->json(['error' => 'Unauthorized'], 401);
    }
})->middleware('auth:sanctum');

Route::prefix('v1/movies')->group(function () {
    Route::get('/', [MovieController::class, 'index']);  // GET request to /api/v1/movies
    Route::post('/', [MovieController::class, 'store']); // POST request to /api/v1/movies
});
