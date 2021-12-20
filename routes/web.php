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

Route::namespace('Publicacion')->middleware(['auth'])->group(function () {
    Route::resource('/publicaciones', 'PublicacionController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy']]);
    Route::post('subirFotos', 'PublicacionController@subirFotos')->name('subirFotos');
    Route::post('eliminarFoto/{anuncio?}', 'PublicacionController@eliminarFoto')->name('eliminarFoto');
    
});

Route::namespace('Compra')->middleware(['auth'])->group(function () {
    Route::get('compras/create/{publicacion_id}', [
        'as' => 'compras.create',
        'uses' => 'CompraController@create'
    ]);
    
    Route::get('/getComunas/{region?}', 'CompraController@getComunas')->name('getComunas');
    
    // Route::resource('/compras', 'CompraController', ['only' => ['index', 'edit', 'store', 'update', 'destroy'], ['except' => 'create']]);

    Route::resource('compras', 'CompraController', ['except' => 'create']);
});

