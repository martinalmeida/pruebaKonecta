<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesionController;

// Rutas Login
Route::controller(SesionController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/check', 'check');
    Route::get('/inicio', 'home')->middleware('auth');
    Route::get('/logout', 'logout');
});
