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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//National_ID
Route::get('/national-id/register', 'CitizenController@create')->name('nric.register');
Route::get('/national-id/update', 'CitizenController@edit')->name('nric.update');