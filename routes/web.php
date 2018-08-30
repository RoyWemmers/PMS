<?php

use Illuminate\Support\Facades\Auth;

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

// Auth check-- Makes sure user can't access app when not logged in
if(!Auth::check()) {
    Route::redirect('*', '/login', 301 );
}

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



