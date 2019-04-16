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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/services', 'PagesController@services');

Route::resource('posts', 'PostsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::get('/cards', 'CardsController@index');

Route::get('/cards/{Card_ID}', 'CardsController@show');

Route::resource('inventories', 'InventoriesController');

Route::any('/search', 'CardsController@search');

Route::resource('wishlists', 'WishlistsController');

Route::resource('trades', 'TradesController');

Route::resource('profile', 'UsersController');

