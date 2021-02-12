<?php

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
    return redirect()->route('home');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/usuario/destroy/{id}', 'UserController@destroy');
Route::get('usuario/edit/usuario/editar', 'UserController@actualizar');
Route::get('/usuario/usuario/edit/{id}', 'UserController@edit');
Route::get('/usuario/edit/{id}', 'UserController@edit');

Route::get('bitacora/destroy/{id}', 'BitacoraController@destroy');
Route::get('bitacora/editar', 'BitacoraController@actualizar');
Route::get('/bitacora/edit/{id}', 'BitacoraController@edit');

Route::resource('bitacora', 'BitacoraController');
Route::resource('avance', 'AvanceController');
Route::resource('usuario', 'UserController');

Route::get('/home', 'HomeController@index')->name('home');



//Route::get('/usuario/{id}', 'UserController@show');

//Route::get('/soporte/{id}', function($id){
//    return 'hola' .$id;
//});