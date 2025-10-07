<?php

use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [ProfileController::class, 'getProfile']);
        Route::post('update', [ProfileController::class, 'updateProfile']);
        Route::post('change-password', [ProfileController::class, 'changePassword']);
        Route::post('logout', [ProfileController::class, 'logout']);

        // User Addresses
        Route::get('addresses', [ProfileController::class, 'getAddresses']);
        Route::post('addresses', [ProfileController::class, 'createAddress']);
        Route::put('addresses/{addressId}', [ProfileController::class, 'updateAddress']);
        Route::delete('addresses/{addressId}', [ProfileController::class, 'deleteAddress']);
    });
});
