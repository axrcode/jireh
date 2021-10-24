<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Profesors Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'docente', 'namespace' => 'Docente', 'middleware' => 'auth'], function()
{
    //  Métodos del Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('docente.dashboard.index');

    //  Métodos de los Cursos del Estudiante
    Route::get('/cursos', 'CursoController@index')->name('docente.curso.index');

    Route::get('/cursos/{curso}/anuncios', 'AnuncioController@index')->name('docente.curso.anuncios.index');
    Route::get('/cursos/{curso}/anuncios/crear', 'AnuncioController@create')->name('docente.curso.anuncios.create');
    Route::post('/cursos/{curso}/anuncios', 'AnuncioController@store')->name('docente.curso.anuncios.store');
    Route::get('/cursos/{curso}/anuncios/{anuncio}/editar', 'AnuncioController@edit')->name('docente.curso.anuncios.edit');
    Route::get('/cursos/{curso}/anuncios/{anuncio}', 'AnuncioController@show')->name('docente.curso.anuncios.show');
    Route::put('/cursos/{curso}/anuncios/{anuncio}', 'AnuncioController@update')->name('docente.curso.anuncios.update');
    Route::put('/cursos/{curso}/anuncios/{anuncio}/destacado', 'AnuncioController@update_destacado')->name('docente.curso.anuncios.update.destacado');
    Route::delete('/cursos/{curso}/anuncios/{anuncio}', 'AnuncioController@destroy')->name('docente.curso.anuncios.destroy');


    Route::get('/cursos/{curso}/actividades', 'ActividadController@index')->name('docente.curso.actividades.index');
    Route::get('/cursos/{curso}/actividades/crear', 'ActividadController@create')->name('docente.curso.actividades.create');
    Route::post('/cursos/{curso}/actividades', 'ActividadController@store')->name('docente.curso.actividades.store');
    Route::get('/cursos/{curso}/actividades/{actividad}/editar', 'ActividadController@edit')->name('docente.curso.actividades.edit');
    Route::get('/cursos/{curso}/actividades/{actividad}', 'ActividadController@show')->name('docente.curso.actividades.show');
    Route::put('/cursos/{curso}/actividades/{actividad}', 'ActividadController@update')->name('docente.curso.actividades.update');
    Route::put('/cursos/{curso}/actividades/{actividad}/destacado', 'ActividadController@update_destacado')->name('docente.curso.actividades.update.destacado');
    Route::delete('/cursos/{curso}/actividades/{actividad}', 'ActividadController@destroy')->name('docente.curso.actividades.destroy');

});
