<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('inicio');

Route::namespace('Publicacion')->group(function () {
    Route::resource('/publicaciones', 'PublicacionController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy']])->middleware(['auth']);
    Route::post('subirFotos', 'PublicacionController@subirFotos')->middleware(['auth'])->name('subirFotos');
    Route::post('eliminarFoto/{anuncio?}', 'PublicacionController@eliminarFoto')->middleware(['auth'])->name('eliminarFoto');
    Route::get('publicaciones/{publicacion_id}/show', [
        'as' => 'publicaciones.show',
        'uses' => 'PublicacionController@show'
    ]);
    
});

Route::namespace('Compra')->middleware(['auth'])->group(function () {
    Route::get('compras/create/{publicacion_id}/{unidades?}', [
        'as' => 'compras.create',
        'uses' => 'CompraController@create'
    ]);
    
    Route::get('/getComunas/{region?}', 'CompraController@getComunas')->name('getComunas');
    
    // Route::resource('/compras', 'CompraController', ['only' => ['index', 'edit', 'store', 'update', 'destroy'], ['except' => 'create']]);

    Route::resource('compras', 'CompraController', ['except' => 'create']);
    Route::get('/compras/recepcion/{compra_id}', 'CompraController@recepcion')->name('recepcion');
    Route::post('/compras/resena/{compra_id}', 'CompraController@resena')->name('resena');
});

Route::namespace('Venta')->group(function () {
    Route::resource('/ventas', 'VentaController', ['only' => ['index']])->middleware(['auth']);
    Route::get('/ventas/enviar/{compra_id}', 'VentaController@enviar')->name('enviar');
});