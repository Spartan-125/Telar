<?php

use App\Http\Controllers\Auth\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::post('login', 'login');
    });
});
