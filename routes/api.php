<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\WorkoutController;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:api'], function () {
    // Auth
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']); 
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']); 
    });

    // Exercises routes
    Route::prefix('exercises')->group(function () {
        Route::get('/', [ExerciseController::class, 'index']);
        Route::get('{id}', [ExerciseController::class, 'show']);
    });

    // Workouts
    Route::prefix('workouts')->group(function () {
        Route::get('/', [WorkoutController::class, 'index']);
    });

});