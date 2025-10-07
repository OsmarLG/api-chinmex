<?php

use App\Http\Controllers\Api\StateController;
use Illuminate\Support\Facades\Route;

Route::prefix('states')->group(function () {
    Route::get('/', [StateController::class, 'index']);
    Route::get('/{id}', [StateController::class, 'show']);
    Route::get('/country/{countryId}', [StateController::class, 'getByCountry']);
});