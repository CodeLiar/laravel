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

Route::get('now', function () {
    return date("Y-m-d H:i:s");
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/my_test', 'HomeController@mytest')->name('test');
Route::get('/my_test2', 'HomeController@mytest2')->name('test2');

Route::get('/login', 'LoginViewController@index')->name('login');
