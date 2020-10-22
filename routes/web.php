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
    return view('usuario.index');
});


// lista de usuarios
Route::get('index', 'App\Http\Controllers\UsuarioController@index');


//crear usuario
Route::post('create', 'App\Http\Controllers\UsuarioController@create');

//editar usuario
Route::get('edit/{id}', 'App\Http\Controllers\UsuarioController@edit');

//update usuario
Route::post('update', 'App\Http\Controllers\UsuarioController@update');

//delete usuario
Route::get('delete/{id}', 'App\Http\Controllers\UsuarioController@delete');
