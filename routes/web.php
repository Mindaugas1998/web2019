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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/items', 'ItemsController@index');

Route::post('/items', 'ItemsController@store');

Route::get('/items/create', 'ItemsController@create');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');