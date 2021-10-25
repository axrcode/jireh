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
    //  Dashboard's Methods
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard.index');

    Route::get('/pedidos', 'PedidoController@index')->name('admin.pedidos.index');
    Route::post('/pedidos', 'PedidoController@store')->name('admin.pedidos.store');
    Route::get('/pedidos/{pedido}/editar', 'PedidoController@edit')->name('admin.pedidos.edit');

    Route::post('/pedidos/{pedido}/detalle', 'PedidoController@detalle_store')->name('admin.pedidos.detalle.store');




    Route::get('/pedidos/crear', 'PedidoController@create')->name('admin.pedidos.create');
    Route::get('/pedidos/{pedido}', 'PedidoController@show')->name('admin.pedidos.show');
    Route::get('/pedidos/{pedido}/detalle', 'PedidoController@detalle')->name('admin.pedidos.detalle');
    Route::put('/pedidos/{pedido}', 'PedidoController@update')->name('admin.pedidos.update');
    Route::delete('/pedidos/{pedido}', 'PedidoController@destroy')->name('admin.pedidos.destroy');


});
