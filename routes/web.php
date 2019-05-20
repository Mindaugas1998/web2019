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

Route::get('/', [
    'uses' => 'ItemsController@getIndex',
    'as' => 'page.index'
]);



Route::get('/items', 'ItemsController@index')->name('items.index');

Route::post('/items', 'ItemsController@store')->name('items.store');

Route::get('/items/create', 'ItemsController@create')->name('items.create');

Route::get('/items/my_items', 'ItemsController@showMyItems')->name('items.my_items');


Route::post('/items/buy_item/{itemID}', 'ItemsController@buyItem')->name('items.buy_item');


Route::get('/items/{itemID}', 'ItemsController@show')->name('items.show');

Route::patch('/items/{itemID}', 'ItemsController@update')->name('items.update');

Route::delete('/items/{itemID}', 'ItemsController@destroy')->name('items.destroy');

Route::get('/items/{itemID}/edit', 'ItemsController@edit')->name('items.edit');








// ITEMS AND USERS INDEX

Route::get('/admin/items', ['middleware' => 'admin', 'as' => 'admin.items.index', 'uses' => 'AdminController@showItems']);
Route::get('/admin/users', ['middleware' => 'admin', 'as' => 'admin.users.index', 'uses' => 'AdminController@showUsers']);

// ITEMS

Route::get('/admin/items/create', ['middleware' => 'admin', 'as' => 'admin.items.create', 'uses' => 'AdminController@createItem']);

Route::post('/admin/items', 'AdminController@storeItem')->name('admin.items.store');

Route::get('/admin/items/{itemsID}', ['middleware' => 'admin', 'as' => 'admin.items.show', 'uses' => 'AdminController@showItem']);

Route::patch('/admin/items/{itemsID}', 'AdminController@updateItem')->name('admin.items.update');



Route::delete('/admin/items/{itemsID}', ['middleware' => 'admin', 'as' => 'admin.items.destroy', 'uses' => 'AdminController@destroyItem']);


Route::get('/admin/items/{itemsID}/edit', ['middleware' => 'admin', 'as' => 'admin.items.edit', 'uses' => 'AdminController@editItem']);


// USERS


Route::post('/admin/users', 'AdminController@storeUser')->name('admin.users.store');

Route::get('/admin/users/create', ['middleware' => 'admin', 'as' => 'admin.users.create', 'uses' => 'AdminController@createUser']);

Route::get('/admin/users/{usersID}', ['middleware' => 'admin', 'as' => 'admin.users.show', 'uses' => 'AdminController@showUser']);

//Route::get('/admin/users/{usersID}', 'AdminController@showUser')->name('admin.users.show');

Route::patch('/admin/users/{usersID}', 'AdminController@updateUser')->name('admin.users.update');


Route::delete('/admin/users/{usersID}', ['middleware' => 'admin', 'as' => 'admin.users.destroy', 'uses' => 'AdminController@destroyUser']);



//Route::delete('/admin/users/{usersID}', 'AdminController@destroyUser')->name('admin.users.destroy');

//Route::get('/admin/users/{usersID}/edit', 'AdminController@editUser')->name('admin.users.edit');


Route::get('/admin/users/{usersID}/edit', ['middleware' => 'admin', 'as' => 'admin.users.edit', 'uses' => 'AdminController@editUser']);


