<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ProductosController;

// Rutas Login
Route::controller(SesionController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/check', 'check');
    Route::get('/inicio', 'home')->middleware('auth');
    Route::get('/logout', 'logout');
});

// Rutas para adminstrar 
Route::controller(ProductosController::class)->group(function () {
    Route::get('/productos', 'index')->middleware('auth');
    Route::get('tablaProductos', 'dataTableProducto')->name('table.producto')->middleware('auth');
    // Route::get('selectRol', 'selectRol')->name('select.roles')->middleware('auth');
    // Route::post('/createUser', 'create')->middleware('auth');
    // Route::get('/user/{id}', 'selectUser')->middleware('auth');
    // Route::post('/updateUser', 'update')->middleware('auth');
    // Route::get('/statusUser/{id}/{status}', 'status')->middleware('auth');
    // Route::get('/deleteUser/{id}', 'delete')->middleware('auth');
});
