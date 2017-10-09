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
    Route::resource('/sliders', 'SlidersController');

    // Redis export/import
    Route::get('/redis/{action}', 'RedisController@execute');

    //  Pages
    Route::get('/pages/create', 'PagesController@create');
    Route::get('/pages', 'PagesController@index');

    //  Posts
    Route::resource('/posts', 'PostsController');
    // Admin Search
    Route::resource('/search', 'SearchController');

});

//  Home route
Route::get('/', 'HomeController@index');
//facebook socialite.
Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

// Post route
Route::get('/{post?}', 'PostsController@show')->where('post', '(.*)');