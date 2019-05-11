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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/items', 'ItemsController@index')->name('items.index');

Route::post('/items', 'ItemsController@store')->name('items.store');

Route::get('/items/create', 'ItemsController@create')->name('items.create');

Route::get('/{itemID}', 'ItemsController@show')->name('items.show');

Route::patch('/{itemID}', 'ItemsController@update')->name('items.update');

Route::delete('/{itemID}', 'ItemsController@destroy')->name('items.destroy');

Route::get('/{itemID}/edit', 'ItemsController@edit')->name('items.edit');






//admin
Route::get('/admin/users', 'AdminController@showUsers')->name('admin.users.index');
//Route::get('/admin/users/{userID}', 'AdminController@deleteUser')->name('admin.items.index');

Route::get('/admin/items', ['middleware' => 'admin', 'as' => 'admin.items.index', 'uses' => 'AdminController@showItems']);
Route::get('/admin/users', ['middleware' => 'admin', 'as' => 'admin.users.index', 'uses' => 'AdminController@showUsers']);


