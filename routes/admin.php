<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function()
{
    //  Dashboard's Methods
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard.index');

    //  Grade's Methods
    Route::get('/grados', 'GradosController@index')->name('admin.grado.index');
    Route::get('/grados/crear', 'GradosController@create')->name('admin.grado.create');
    Route::post('/grados', 'GradosController@store')->name('admin.grado.store');
    Route::get('/grados/{grado}', 'GradosController@show')->name('admin.grado.show');
    Route::get('/grados/{grado}/editar', 'GradosController@edit')->name('admin.grado.edit');
    Route::put('/grados/{grado}', 'GradosController@update')->name('admin.grado.update');
    Route::get('/grados/{grado}/eliminar', 'GradosController@delete')->name('admin.grado.delete');
    Route::delete('/grados/{grado}', 'GradosController@destroy')->name('admin.grado.destroy');

    //  Courses' Methods
    Route::get('/cursos', 'CursoController@index')->name('admin.curso.index');
    Route::get('/grados/{grado}/cursos/crear', 'CursoController@create')->name('admin.curso.create');
    Route::post('/cursos', 'CursoController@store')->name('admin.curso.store');
    Route::get('/grados/{grado}/cursos/{curso}', 'CursoController@show')->name('admin.curso.show');
    Route::get('/grados/{grado}/cursos/{curso}/editar', 'CursoController@edit')->name('admin.curso.edit');
    Route::put('/grados/{grado}/cursos/{curso}', 'CursoController@update')->name('admin.curso.update');
    Route::get('/grados/{grado}/cursos/{curso}/eliminar', 'CursoController@delete')->name('admin.curso.delete');
    Route::delete('/grados/{grado}/cursos/{curso}', 'CursoController@destroy')->name('admin.curso.destroy');

    //  Collaborator's Methods
    Route::get('/colaboradores', 'ColaboradorController@index')->name('admin.colaborador.index');
    Route::get('/colaboradores/crear', 'ColaboradorController@create')->name('admin.colaborador.create');
    Route::post('/colaboradores', 'ColaboradorController@store')->name('admin.colaborador.store');
    Route::get('/colaboradores/{colaborador}', 'ColaboradorController@show')->name('admin.colaborador.show');
    Route::get('/colaboradores/{colaborador}/editar', 'ColaboradorController@edit')->name('admin.colaborador.edit');
    Route::put('/colaboradores/{colaborador}', 'ColaboradorController@update')->name('admin.colaborador.update');
    Route::delete('/colaboradores/{colaborador}', 'ColaboradorController@destroy')->name('admin.colaborador.destroy');

    //  Cursos Asignados al Colaborador (Docente)
    Route::get('/colaboradores/{colaborador}/cursos', 'ColaboradorController@cursos_index')->name('admin.colaborador.cursos_index');
    Route::get('/colaboradores/{colaborador}/cursos/nuevo', 'ColaboradorController@cursos_create')->name('admin.colaborador.cursos_create');

    Route::get('/grados/{grado}/cursos/{curso}/docente', 'CursoController@curso_docente_create')->name('admin.curso.curso_docente.create');
    Route::post('/grados/{grado}/cursos/{curso}/docente', 'CursoController@curso_docente_store')->name('admin.curso.curso_docente.store');

    //  Student's Methods
    Route::get('/estudiantes', 'EstudianteController@index')->name('admin.estudiante.index');
    Route::get('/estudiantes/crear', 'EstudianteController@create')->name('admin.estudiante.create');
    Route::post('/estudiantes', 'EstudianteController@store')->name('admin.estudiante.store');
    Route::get('/estudiantes/{estudiante}', 'EstudianteController@show')->name('admin.estudiante.show');
    Route::get('/estudiantes/{estudiante}/editar', 'EstudianteController@edit')->name('admin.estudiante.edit');
    Route::put('/estudiantes/{estudiante}', 'EstudianteController@update')->name('admin.estudiante.update');
    Route::delete('/estudiantes/{estudiante}', 'EstudianteController@destroy')->name('admin.estudiante.destroy');
    //  Inscripcion de Estudiantes
    Route::get('/estudiantes/{estudiante}/inscripcion', 'EstudianteController@inscripcion')->name('admin.estudiante.inscripcion');
    Route::get('/estudiantes/{estudiante}/inscripcion/{grado}', 'EstudianteController@confirmarinscripcion')->name('admin.estudiante.confirmarinscripcion');
    Route::post('/estudiantes/{estudiante}/inscripcion/{grado}', 'EstudianteController@inscribir')->name('admin.estudiante.inscribir');
    //  Cambiar grado a Estudiantes
    Route::get('/estudiantes/{estudiante}/cambiar-grado', 'EstudianteController@cambiargrado')->name('admin.estudiante.cambiargrado');
    Route::get('/estudiantes/{estudiante}/cambiar-grado/{grado}', 'EstudianteController@confirmargrado')->name('admin.estudiante.confirmargrado');
    Route::put('/estudiantes/{estudiante}/cambiar-grado/{grado}', 'EstudianteController@nuevogrado')->name('admin.estudiante.nuevogrado');

    //  Cambiar Fotografia de Estudiantes y Colaboradores
    Route::get('/cambiar-fotografia/{user}', 'FotoController@index')->name('admin.foto.index');
    Route::put('/cambiar-fotografia/{user}', 'FotoController@update')->name('admin.foto.update');

    //  Parámetros Generales
    Route::get('/configuracion/parametros-generales', 'ConfigGeneralController@generales')->name('admin.configuracion.generales');
    Route::put('/configuracion/parametros-generales', 'ConfigGeneralController@generales_update')->name('admin.configuracion.generales.update');

    //  Códigos para Inscripciones en línea
    Route::get('/inscripciones/codigos/crear', 'InscripcionesController@codigo_create')->name('admin.inscripcion.codigo.create');
    Route::post('/inscripciones/codigos/crear', 'InscripcionesController@codigo_store')->name('admin.inscripcion.codigo.store');
    Route::get('/inscripciones/codigos/{codigo}', 'InscripcionesController@codigo_show')->name('admin.inscripcion.codigo.show');
    Route::delete('/inscripciones/codigos/{codigo}', 'InscripcionesController@codigo_destroy')->name('admin.inscripcion.codigo.destroy');









    //  Rutas para generar PDF
    Route::get('/documento/codigo-inscripcion/{codigo}', 'PDFController@codigo_inscripcion')->name('admin.pdf.codigo_inscripcion.show');
});
