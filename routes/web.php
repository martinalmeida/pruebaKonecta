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
    Route::get('selectCategoria', 'selectCategoria')->name('select.categoria')->middleware('auth');
    Route::post('/createProducto', 'create')->middleware('auth');
    Route::get('/producto/{id}', 'selectProducto')->middleware('auth');
    Route::post('/updateProducto', 'update')->middleware('auth');
    Route::get('/statusProducto/{id}/{status}', 'status')->middleware('auth');
    Route::get('/deleteProducto/{id}', 'delete')->middleware('auth');
});
