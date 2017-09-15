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

Route::get('/test', function () {
    return view('auth.login_test');
});


Auth::routes();


Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => 'auth'
], function() {
    // Admin Dashboard
    Route::get('/', 'HomeController@index');

});