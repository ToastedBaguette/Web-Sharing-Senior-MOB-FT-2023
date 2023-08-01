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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login2');

Auth::routes();

// Group
Route::group(['middleware' => ['auth', 'group']],
    function () {
        Route::get('/home', 'GroupController@index')->name('home');
        Route::post('/request', 'GroupController@request')->name('request');
    }
);

// Senior
Route::group(['middleware' => ['auth', 'senior']],
    function () {        
        Route::get('/detail/{id}', 'SeniorController@detail')->name('detail');
        Route::get('/senior', 'SeniorController@index')->name('senior');
        Route::post('/send-response', 'SeniorController@sendResponse')->name('send.response');
    }
);




