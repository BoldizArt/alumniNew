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

#### Home page
Route::get('/', 'Home\HomeController@index')->name('home');

#### Auth routes
Auth::routes();

#### Ajax routes
// Save uploaded image
Route::post('/profile/image', 'Actions\ActionsController@saveImage')->name('ajax.image');
// Return search result
Route::post('/search', 'Search\SearchController@get')->name('ajax.search');

#### Public pages
Route::get('/profiles', 'Profile\PublicController@index')->name('public.index');
Route::get('/profile/{profile}', 'Profile\PublicController@show')->where('profile', '[A-Za-z0-9]+')->name('public.show');
Route::get('/news', 'Profile\PublicController@news')->name('public.news');
Route::get('/contact', 'Profile\PublicController@contact')->name('public.contact');
Route::get('/team', 'Profile\PublicController@team')->name('public.team');
Route::get('/team/{team}', 'Profile\PublicController@teamMember')->where('team', '[A-Za-z0-9]+')->name('public.team.member');

#### User pages
Route::get('/profile/me/create', 'Profile\UserController@create')->name('user.create');
Route::post('/profile', 'Profile\UserController@store')->name('user.store');
Route::get('/profile/me/show', 'Profile\UserController@show')->name('user.show');
Route::get('/profile/me/edit', 'Profile\UserController@edit')->name('user.edit');
Route::post('/profile/me/update', 'Profile\UserController@update')->name('user.update');
Route::delete('/profile/me/destroy', 'Profile\UserController@destroy')->name('user.destroy');

#### Admin pages
Route::get('/temporary/profiles', 'Profile\AdminController@index')->name('admin.index');
Route::get('/temporary/profile/{profile}', 'Profile\AdminController@show')->where('profile', '[A-Za-z0-9]+')->name('admin.show');
Route::get('/temporary/profiles/create', 'Profile\AdminController@create')->name('admin.create');
Route::post('/temporary/profiles', 'Profile\AdminController@store')->name('admin.store');
Route::get('/temporary/profiles/created', 'Profile\AdminController@created')->name('admin.created');
// Route::get('/edit/profile', 'Profile\AdminController@edit')->name('edit.profile');
// Route::post('/update/profile/me', 'Profile\AdminController@update')->name('update.profile');
// Route::delete('/destroy/profile/me', 'Profile\AdminController@destroy')->name('destroy.profile');
Route::post('/temporary/profiles/accept', 'Profile\AdminController@accept')->name('admin.accept');
Route::get('/edit', 'Profile\AdminController@index')->name('admin.home');
Route::get('/news/create', 'Profile\AdminController@index')->name('admin.news');

Route::get('/team/{team}/edit', 'Profile\AdminController@teamEdit')->where('team', '[A-Za-z0-9]+')->name('admin.team-edit');
Route::delete('/team/destroy', 'Profile\AdminController@teamDestroy')->name('admin.team-destroy');


// Test route
Route::get('/test', 'Test\Test@test')->name('test');

// Send mail route.
Route::post('send/mail', 'Email\EmailActions@send')->name('send.mail')->middleware('auth');