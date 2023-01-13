<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VentasController;

// Rutas Login
Route::controller(SesionController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/check', 'check');
    Route::get('/inicio', 'home')->middleware('auth');
    Route::get('/logout', 'logout');
});

// Rutas para adminstrar los Productos
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

// Rutas para adminstrar los stocks de los Productos
Route::controller(StockController::class)->group(function () {
    Route::get('/stocks', 'index')->middleware('auth');
    Route::get('tablaStocks', 'dataTableStock')->name('table.stock')->middleware('auth');
    Route::get('selectProducto', 'selectProducto')->name('select.producto')->middleware('auth');
    Route::get('/stock/{id}', 'selectStock')->middleware('auth');
    Route::post('/updateStock', 'update')->middleware('auth');
});

// Rutas para adminstrar las ventas de los Productos
Route::controller(VentasController::class)->group(function () {
    Route::get('/ventas', 'index')->middleware('auth');
    Route::get('tablaVentas', 'dataTableVentas')->name('table.ventas')->middleware('auth');
    Route::get('selectStock', 'selectProductosStock')->name('select.productoStock')->middleware('auth');
    Route::post('/createVenta', 'create')->middleware('auth');
    Route::get('/venta/{id}', 'selectVenta')->middleware('auth');
    Route::post('/updateVenta', 'update')->middleware('auth');
    Route::get('/statusVenta/{id}/{status}', 'status')->middleware('auth');
    Route::get('/deleteVenta/{id}', 'delete')->middleware('auth');
});
