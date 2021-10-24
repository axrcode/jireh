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

Route::get('/inscripcion', 'InscripcionController@index')->name('public.inscripcion.index');
Route::post('/inscripcion', 'InscripcionController@validacion')->name('public.inscripcion.validacion');

Route::get('/inscripcion/crear', 'InscripcionController@create')->name('public.inscripcion.create');
Route::post('/inscripcion/crear', 'InscripcionController@store')->name('public.inscripcion.store');

Route::get('/inscripcion/grado', 'InscripcionController@seleccionar_grado')->name('public.inscripcion.grado');
Route::post('/inscripcion/grado', 'InscripcionController@asignar_grado')->name('public.inscripcion.grado.save');

Route::get('/inscripcion/exitosa', 'InscripcionController@exitosa')->name('public.inscripcion.exitosa');
