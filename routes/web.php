<?php

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

// Rutas de Auntenticación
Auth::routes();

// Página Princiale
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

// Vista para realizar busquedas y/o resultados
Route::get('/search-names', 'SearchNamesController@index')->name('search-names');

// Ruta Para generar resultados en base a la busqueda de los nombres
Route::post('/search-names', 'SearchNamesController@search');

// Ruta para geerar PDF
Route::get('/export-pdf', 'SearchNamesController@exportPDF')->name('export-pdf');
