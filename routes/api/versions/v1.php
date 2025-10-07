<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require __DIR__ . '/v1/auth.php';
    require __DIR__ . '/v1/users.php';
    require __DIR__ . '/v1/user_addresses.php';
    require __DIR__ . '/v1/countries.php';
    require __DIR__ . '/v1/states.php';
    require __DIR__ . '/v1/profile.php';
});
