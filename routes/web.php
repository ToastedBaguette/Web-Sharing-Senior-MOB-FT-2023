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
    return view('auth.login');
});

Auth::routes();
Route::get('/senior', function(){
    return view('senior');
});
Route::get('/home', 'GroupController@index')->name('home');
Route::get('/detail/{id}', 'SeniorController@index')->name('detail');
Route::post('/request', 'GroupController@request')->name('request');
