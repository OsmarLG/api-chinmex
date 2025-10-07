<?php

use App\Http\Controllers\Api\UserAddressController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Resource routes authorize via UserAddressPolicy through authorizeResource in the controller
    Route::apiResource('user-addresses', UserAddressController::class);
});