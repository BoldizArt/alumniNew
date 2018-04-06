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

Route::get('/', 'Home\HomeController@index');

Auth::routes();

// Route::resource('/profile', 'ProfileController');

Route::get('/profiles', 'Profile\PublicProfileController@index')->name('profile.index');
Route::post('/profiles', 'Profile\ProfileController@store')->name('profile.store');

Route::get('/profile/{profile}', 'Profile\PublicProfileController@show')->where('profile', '[A-Za-z0-9]+')->name('profile.show');
Route::delete('/profile/{profile}', 'Profile\ProfileController@destroy')->where('profile', '[A-Za-z0-9]+')->name('profile.destroy');

Route::get('/profile/me/create', 'Profile\ProfileController@create')->name('profile.create');
Route::get('/profile/me/edit', 'Profile\ProfileController@edit')->name('profile.edit');
Route::get('/profile/me/show', 'Profile\ProfileController@show')->name('profile.self');
Route::post('/profile/me/update', 'Profile\ProfileController@update')->name('profile.update');

Route::post('/search', 'Search\SearchController@get')->name('profile.search');
Route::get('/search', 'Search\SearchController@index')->name('search.form');
