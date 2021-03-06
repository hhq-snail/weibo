<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/', 'StaticPageController@home')->name('home');
Route::get('/help', 'StaticPageController@help')->name('help');
Route::get('/about', 'StaticPageController@about')->name('about');
Route::get('/signup', 'UsersController@create')->name('signup');
