<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Students Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'estudiante', 'namespace' => 'Estudiante', 'middleware' => 'auth'], function()
{
    //  Métodos del Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('estudiante.dashboard.index');

    //  Métodos de los Cursos del Estudiante
    Route::get('/cursos', 'CursoController@index')->name('estudiante.curso.index');
});
