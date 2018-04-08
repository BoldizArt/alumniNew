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

Route::get('/', 'Home\HomeController@index')->name('home');

Auth::routes();

// Route::resource('/profile', 'ProfileController');

Route::get('/profiles', 'Profile\PublicProfileController@index')->name('profile.index');
Route::post('/profiles', 'Profile\ProfileController@store')->name('profile.store');

Route::get('/temporary/profiles', 'Profile\ProfileController@TemporaryProfiles')->name('temporary.profiles');


Route::get('/profile/{profile}', 'Profile\PublicProfileController@show')->where('profile', '[A-Za-z0-9]+')->name('profile.show');
Route::delete('/profile/{profile}', 'Profile\ProfileController@destroy')->where('profile', '[A-Za-z0-9]+')->name('profile.destroy');
Route::get('/profile/accept', 'Profile\ProfileController@acceptProfile')->name('profile.accept');
Route::get('/temporary/profile/{profile}', 'Profile\ProfileController@TemporaryProfile')->where('profile', '[A-Za-z0-9]+')->name('temporary.profile');

Route::get('/profile/me/create', 'Profile\ProfileController@create')->name('profile.create');
Route::get('/profile/me/edit', 'Profile\ProfileController@edit')->name('profile.edit');
Route::get('/profile/me/show', 'Profile\ProfileController@show')->name('profile.self');
Route::post('/profile/me/update', 'Profile\ProfileController@update')->name('profile.update');




Route::post('/search', 'Search\SearchController@get')->name('profile.search');
Route::get('/search', 'Search\SearchController@index')->name('search.form');

Route::get('/ajax/image', function(){

/*
    $im = imagecreatefrompng('http://localhost:8000/images/asdasd_1522531709.png');
    $size = min(imagesx($im), imagesy($im));
    $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
    if ($im2 !== FALSE) {
        imagepng($im2, 'example-cropped.png');
        imagedestroy($im2);
    }
    imagedestroy($im);
*/

    return view('profile.self');
});
Route::post('/profile/image', 'Profile\ProfileController@image')->name('profile.image');

