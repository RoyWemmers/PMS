<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckAdmin;

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


Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::get('', 'DashboardController@rootRedirect');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::prefix('projects')->group(function () {
        Route::get('', 'ProjectController@index')->name('projects');

        Route::get('create', 'ProjectController@create');
        Route::post('create', 'ProjectController@store');

        Route::get('{id}', 'ProjectController@show')->name('projects.show');
        Route::post('{id}', 'ProjectController@update');

        Route::post('{id}/destroy', 'ProjectController@destroy')->middleware('checkadmin');
    });

    Route::prefix('deadlines')->group(function () {
        Route::post('{id}', 'DeadlineController@update');
        Route::post('', 'DeadlineController@store');
        Route::post('{id}/destroy', 'DeadlineController@destroy');
    });
});





