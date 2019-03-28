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
Route::get('/auth/editPassword', 'Auth\PasswordController@index')->name('passwords.index');
Route::post('/auth/editPassword', 'Auth\PasswordController@changePassword')->name('passwords.update');
Route::get('/national-id/view', 'CitizenController@view')->name('nric.view');
Route::get('/qrcode/scan', 'CitizenController@qrScan')->name('qr.scan');
Route::get('/qrcode/display', 'CitizenController@qrDisplay')->name('qr.display');

//Admin
Route::group(['middleware' => 'role:admin'], function(){

  Route::get('/national-id/create', 'CitizenController@create')->name('nric.create');
  Route::get('/national-id/update', 'CitizenController@edit')->name('nric.update');
  Route::post('/national-id/store', 'CitizenController@store')->name('nric.store');
  Route::post('/national-id/update', 'CitizenController@update')->name('nric.update');
  Route::post('/national-id/register', 'CitizenController@register')->name('nric.register');
  Route::post('/national-id/loadAllCitizen', 'CitizenController@loadallcitizen')->name('nric.load-citizen');
  Route::post('/national-id/listing', 'CitizenController@listing')->name('nric.listing');
  Route::get('/loading', 'HomeController@loading')->name('loading');

});
