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

Route::middleware(['guest'])->group(function () {
    Route::get('/', 'SessionsController@index')->name('login');
    Route::post('/login', 'SessionsController@store');

    Route::get('/verifieer/{confirmationCode}', 'SessionsController@show');
    Route::post('/verifieer/update/{confirmationCode}', 'SessionsController@update');

    Route::get('/wachtwoord-vergeten', 'PasswordResetController@index');
    Route::post('/wachtwoord-vergeten/update', 'PasswordResetController@mail');
    Route::get('/wachtwoord-vergeten/update/{confirmationCode}', 'PasswordResetController@show');
    Route::post('/wachtwoord-vergeten/update/{confirmationCode}', 'PasswordResetController@update');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', 'SessionsController@destroy');

    Route::get('/boodschappen', 'GroceriesController@index')->name('home');
    Route::get('/boodschappen/populair', 'GroceriesController@allPopularGroceries');
    Route::get('/boodschappen/populair/{description}', 'GroceriesController@specificPopularGroceries');
    Route::get('/boodschappen/alles', 'GroceriesController@allGroceries');
    Route::post('/boodschappen', 'GroceriesController@store');
    Route::post('/boodschappen/{id}/update', 'GroceriesController@update');
    Route::post('/boodschappen/{id}/delete', 'GroceriesController@destroy');
    Route::post('/boodschappen/reset', 'GroceriesController@reset');

    Route::get('/geschiedenis', 'HistoryController@index');
    Route::get('/geschiedenis/alles', 'HistoryController@entireHistory');

    Route::get('/instellingen', 'SettingsController@index');
    Route::post('/instellingen/{id}/wachtwoord', 'SettingsController@update');

    Route::group(['middleware' => 'admin'], function ()
    {
        Route::get('/planning', 'ScheduleController@index');
        Route::post('/planning', 'ScheduleController@store');
        Route::post('/planning/{id}/delete', 'ScheduleController@destroy');

        Route::get('/gebruikers', 'UsersController@index');
        Route::post('/gebruikers/toevoegen', 'UsersController@store');
        Route::post('/gebruikers/{id}/update', 'UsersController@update');
        Route::post('/gebruikers/{id}/delete', 'UsersController@destroy');
    });
});