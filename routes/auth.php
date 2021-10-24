<?php

use Illuminate\Auth\Events\Login;
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

//  Home Redirect
Route::get('/', 'HomeController@index')->name('home.index');

//  Login's Method
Route::get('/login', 'LoginController@index')->name('login.index')->middleware('guest');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
