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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Route::get('/movimentos', function(){
    return view('movimentos');
}); */




Route::get('/empresa', function(){
    return 'empresa';
});


Route::view('movimentos', 'movimentos');
Route::view('tipos', 'tipos');
Route::view('movimentos', 'movimentos');
Route::view('tarifas', 'tarifas');
Route::view('empresa', 'empresa');