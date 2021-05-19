<?php

use Illuminate\Support\Facades\Auth;
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

// Auth::routes();
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/print', 'PrintController@print')->name('print');
Route::resource('/causa-fallas', 'CausaFallaController')->names('causa-fallas');
Route::resource('/componentes', 'ComponenteController')->names('componentes');
Route::resource('/efecto-fallas', 'EfectoFallaController')->names('efecto-fallas');
Route::resource('/falla-funcionals', 'FallaFuncionalController')->names('falla-funcionals');
Route::resource('/funcions', 'FuncionController')->names('funcions');
Route::resource('/funcion-subsistemas', 'FuncionSubsistemaController')->names('funcion-subsistemas');
Route::resource('/modo-fallas', 'ModoFallaController')->names('modo-fallas');
Route::resource('/partes', 'ParteController')->names('partes');
Route::resource('/sistemas', 'SistemaController')->names('sistemas');
Route::resource('/actividades', 'ActividadController')->names('actividades');
