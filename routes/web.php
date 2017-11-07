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

Route::get('/', 'SessionsController@index')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/boodschappen', 'GroceriesController@index')->name('home');
Route::post('/boodschappen', 'GroceriesController@store');
Route::get('/boodschappen/{id}', 'GroceriesController@findById');
Route::post('/boodschappen/{id}/update', 'GroceriesController@update');
Route::post('/boodschappen/reset', 'GroceriesController@reset');