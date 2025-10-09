<?php

use App\Http\Controllers\Api\LovsController;
use Illuminate\Support\Facades\Route;

Route::prefix('lovs')->group(function () {
    Route::get('/countries', [LovsController::class, 'countries']);
    Route::get('/states', [LovsController::class, 'states']);
});