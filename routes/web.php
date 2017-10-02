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
Route::get('/', 'HomeController@index');

//  Language route
Route::post('/language-chooser', 'LanguageController@changeLanguage');

Route::post('/language/', array(
        'before' => 'csrf',
        'as' => 'language-chooser',
        'uses' => 'LanguageController@changeLanguage'
    )
);

Auth::routes();


Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => 'admin'
], function() {
    // Admin Dashboard
    Route::get('/', 'HomeController@index');
    // Admin Users
    Route::resource('/users', 'UsersController');

    //  Manage Sliders
    Route::get('/sliders', 'SlidersController@index');
    Route::post('/sliders', 'SlidersController@store');

    //    Ajax edit slider
    Route::get('/sliders/edit', 'SlidersController@edit');

    // Redis export/import
    Route::get('/redis/{action}', 'RedisController@execute');

});

//facebook socialite.
Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');