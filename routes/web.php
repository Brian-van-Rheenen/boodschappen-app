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
Route::get('/logout', 'SessionsController@destroy');
Route::get('/boodschappen', 'GroceriesController@index')->name('home');
Route::get('/boodschappen/popular', 'GroceriesController@allPopularGroceries');
Route::get('/boodschappen/popular/{description}', 'GroceriesController@specificPopularGroceries');
Route::get('/boodschappen/all', 'GroceriesController@allGroceries');
Route::post('/boodschappen', 'GroceriesController@store');
Route::get('/boodschappen/{id}', 'GroceriesController@findById');
Route::post('/boodschappen/{id}/update', 'GroceriesController@update');
Route::post('/boodschappen/{id}/delete', 'GroceriesController@destroy');
Route::post('/boodschappen/reset', 'GroceriesController@reset');

Route::group(['middleware' => 'admin'], function ()
{
    Route::get('/history', 'HistoryController@index');
    Route::get('/history/all', 'HistoryController@entireHistory');
    Route::get('/users', 'UsersController@index');
    Route::post('/users/toevoegen', 'UsersController@store');
});