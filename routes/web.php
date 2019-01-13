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

Route::get('/', 'PagesController@index')->name('index');

Route::get('submit', 'PropertiesController@create')->name('create');

Route::get('contact', 'PagesController@contact')->name('contact');

Route::get('ur-specials', 'PagesController@urSpecials')->name('ur-specials');

Route::get('about', 'PagesController@about')->name('about');

Route::get('privacy', 'PagesController@privacy')->name('privacy');

Route::get('terms-and-conditions', 'PagesController@terms')->name('terms');

Route::resource('properties', 'PropertiesController');

Route::post('properties/{property}/enquiry', 'PropertiesController@enquiry')->name('property.enquiry');

Route::post('upload', 'UploadsController@store');

Auth::routes();
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('home', 'HomeController@index')->name('profile');
Route::get('home/mobile', 'HomeController@mobile')->name('home.mobile');
Route::post('home/mobile', 'HomeController@updateMobile')->name('update.mobile');
Route::get('dashboard/properties', 'HomeController@properties')->name('dashboard.properties');
Route::patch('home', 'UsersController@update')->name('profile.update');
