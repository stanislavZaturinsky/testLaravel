<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'UsersController@index');

Route::get('users/create', 'UsersController@create');
Route::post('users/create', 'UsersController@store');

Route::get('users/edit/{id}', 'UsersController@edit');
Route::post('users/edit/{id}', 'UsersController@update');

Route::get('users/show/{id}', 'UsersController@show');

Route::post('users/delete/{id}', 'UsersController@delete');

Route::get('addresses/create/{userId}', 'AddressesController@create');
Route::post('addresses/create/{userId}', 'AddressesController@store');

Route::get('addresses/edit/{id}', 'AddressesController@edit');
Route::post('addresses/edit/{id}', 'AddressesController@update');

Route::post('addresses/delete/{id}', 'AddressesController@delete');