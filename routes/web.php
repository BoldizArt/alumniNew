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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

// Route::resource('/profile', 'ProfileController');

Route::get('/profile', 'PublicProfileController@index')->name('profile.index');
Route::post('/profile', 'ProfileController@store')->name('profile.store');

Route::get('/profile/{profile}', 'PublicProfileController@show')->where('profile', '[A-Za-z0-9]+')->name('profile.show');
Route::delete('/profile/{profile}', 'ProfileController@destroy')->where('profile', '[A-Za-z0-9]+')->name('profile.destroy');

Route::get('/profile/me/create', 'ProfileController@create')->name('profile.create');
Route::get('/profile/me/edit', 'ProfileController@edit')->name('profile.edit');
Route::get('/profile/me/show', 'ProfileController@show')->name('profile.self');
Route::post('/profile/me/update', 'ProfileController@update')->name('profile.update');
