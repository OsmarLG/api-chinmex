<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Resource routes authorize via UserPolicy through authorizeResource in the controller
    Route::apiResource('users', UserController::class);

    // Additional user maintenance routes with permission checks
    Route::post('users/{user}/restore', [UserController::class, 'restore'])
        ->middleware('can:users.restore');

    Route::delete('users/{user}/force', [UserController::class, 'forceDelete'])
        ->middleware('can:users.force-delete');
});
