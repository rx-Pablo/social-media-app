<?php

use App\Models\User;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Private Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'v1'], function() {

        /**
         * User API Routes
         */
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/logout', [AuthController::class, 'logout'])->name('users.logout');

    });
});

// Public Routes
Route::group(['prefix' => 'v1'], function() {

    /**
     * User API Routes
     */
    Route::post('/new-user', [AuthController::class, 'register'])->name('users.register'); // Create a new user
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Get all users
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show'); // Get a single user
    Route::post('/login', [AuthController::class, 'login'])->name('users.login'); // Login a user

});