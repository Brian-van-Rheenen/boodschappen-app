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
Route::get('/boodschappen/populair', 'GroceriesController@allPopularGroceries');
Route::get('/boodschappen/populair/{description}', 'GroceriesController@specificPopularGroceries');
Route::get('/boodschappen/alles', 'GroceriesController@allGroceries');
Route::post('/boodschappen', 'GroceriesController@store');
Route::post('/boodschappen/{id}/update', 'GroceriesController@update');
Route::post('/boodschappen/{id}/delete', 'GroceriesController@destroy');
Route::post('/boodschappen/reset', 'GroceriesController@reset');

Route::get('/history', 'HistoryController@index');
Route::get('/history/alles', 'HistoryController@entireHistory');

Route::get('/instellingen', 'SettingsController@index');
Route::post('/instellingen/{id}/wachtwoord', 'SettingsController@update');

Route::group(['middleware' => 'admin'], function ()
{
    Route::get('/users', 'UsersController@index');
    Route::post('/users/toevoegen', 'UsersController@store');
    Route::post('/users/{id}/update', 'UsersController@update');
    Route::post('/users/{id}/delete', 'UsersController@destroy');
});