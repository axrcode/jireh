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


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function()
{
    //  Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard.index');
    Route::post('/dashboard/pedidos/estados', 'DashboardController@graphic')->name('admin.dashboard.graphic');

    //  Clientes
    Route::get('/clientes', 'ClienteController@index')->name('admin.clientes.index');
    Route::get('/clientes/crear', 'ClienteController@create')->name('admin.clientes.create');
    Route::post('/clientes', 'ClienteController@store')->name('admin.clientes.store');
    Route::get('/clientes/{cliente}', 'ClienteController@show')->name('admin.clientes.show');
    Route::get('/clientes/{cliente}/editar', 'ClienteController@edit')->name('admin.clientes.edit');
    Route::put('/clientes/{cliente}', 'ClienteController@update')->name('admin.clientes.update');
    Route::delete('/clientes/{cliente}', 'ClienteController@destroy')->name('admin.clientes.destroy');

    //  Departamentos
    Route::get('/departamentos', 'DeptoController@index')->name('admin.departamentos.index');
    Route::get('/departamentos/crear', 'DeptoController@create')->name('admin.departamentos.create');
    Route::post('/departamentos', 'DeptoController@store')->name('admin.departamentos.store');
    Route::get('/departamentos/{departamento}', 'DeptoController@show')->name('admin.departamentos.show');
    Route::get('/departamentos/{departamento}/editar', 'DeptoController@edit')->name('admin.departamentos.edit');
    Route::put('/departamentos/{departamento}', 'DeptoController@update')->name('admin.departamentos.update');
    Route::delete('/departamentos/{departamento}', 'DeptoController@destroy')->name('admin.departamentos.destroy');

    //  Empleados
    Route::get('/empleados', 'EmpleadoController@index')->name('admin.empleados.index');
    Route::get('/empleados/crear', 'EmpleadoController@create')->name('admin.empleados.create');
    Route::post('/empleados', 'EmpleadoController@store')->name('admin.empleados.store');
    Route::get('/empleados/{empleado}', 'EmpleadoController@show')->name('admin.empleados.show');
    Route::get('/empleados/{empleado}/editar', 'EmpleadoController@edit')->name('admin.empleados.edit');
    Route::put('/empleados/{empleado}', 'EmpleadoController@update')->name('admin.empleados.update');
    Route::delete('/empleados/{empleado}', 'EmpleadoController@destroy')->name('admin.empleados.destroy');

    //  Pedidos
    Route::get('/pedidos', 'PedidoController@index')->name('admin.pedidos.index');
    Route::get('/pedidos/crear', 'PedidoController@create')->name('admin.pedidos.create');
    Route::post('/pedidos', 'PedidoController@store')->name('admin.pedidos.store');
    Route::get('/pedidos/{pedido}', 'PedidoController@show')->name('admin.pedidos.show');
    Route::get('/pedidos/{pedido}/editar', 'PedidoController@edit')->name('admin.pedidos.edit');
    Route::put('/pedidos/{pedido}', 'PedidoController@update')->name('admin.pedidos.update');
    Route::delete('/pedidos/{pedido}', 'PedidoController@destroy')->name('admin.pedidos.destroy');

    //  Detalle Pedidos
    Route::post('/pedidos/{pedido}/detalle', 'PedidoController@detalle_store')->name('admin.pedidos.detalle.store');
    Route::put('/pedidos/{pedido}/detalle/{detalle}', 'PedidoController@detalle_update')->name('admin.pedidos.detalle.update');
    Route::delete('/pedidos/{pedido}/detalle/{detalle}', 'PedidoController@detalle_destroy')->name('admin.pedidos.detalle.destroy');

    //  Proceso de Pedidos
    Route::get('/proceso-pedidos', 'PedidoController@proceso_index')->name('admin.procesos.index');

    //  Reporte de Pedidos
    Route::get('/reporte/pedidos', 'PedidoController@reporte_pedidos')->name('admin.reporte.pedidos');

});
