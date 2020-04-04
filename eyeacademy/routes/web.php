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
    return view('dashboard');
})->middleware('auth');

Auth::routes([
    'register' => false
]);


Route::middleware('auth')->group(function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('/account')->group(function () {
        Route::get('/', 'AccountController@index')->name('account');
        Route::prefix('/{id}')->group(function () {
            Route::get('/', 'AccountController@view')->name('account.view');
            Route::patch('/', 'AccountController@update')->name('account.update');
        });
    });

    Route::prefix('/patient')->group(function() {
        Route::get('/', 'PatientController@index')->name('patient');
        Route::post('/', 'PatientController@create');
        Route::prefix('/{id}')->group(function() {
            Route::get('/', 'PatientController@view')->name('patient.view');
            Route::delete('/', 'PatientController@delete')->name('patient.delete');
            Route::patch('/', 'PatientController@update')->name('patient.update');
        });
    });

    Route::prefix('/staff')->group(function() {
        Route::get('/', 'UserController@index')->name('staff');
        Route::post('/', 'UserController@create');
        Route::prefix('/{id}')->group(function() {
            Route::get('/', 'UserController@view')->name('staff.view');
            Route::delete('/', 'UserController@delete')->name('staff.delete');
            Route::patch('/', 'UserController@update')->name('staff.update');
        });
    });

    Route::prefix('/station')->group(function() {
        Route::get('/', 'StationController@index')->name('station');
        Route::post('/', 'StationController@create');
        Route::prefix('/{id}')->group(function() {
            Route::get('/', 'StationController@view')->name('station.view');
            Route::delete('/', 'StationController@delete')->name('station.delete');
            Route::patch('/', 'StationController@update')->name('station.update');
            Route::prefix('/visit')->group(function() {
                Route::get('/', 'VisitController@index')->name('visit');
                Route::post('/', 'VisitController@create');
                Route::put('/{track_id}', 'VisitController@update')->name('finishvisit');
            });
        });
    });

    Route::prefix('/report')->group(function() {
        Route::get('/', 'ReportController@index')->name('report');
        Route::prefix('/{id}')->group(function() {
            Route::get('/', 'ReportController@currentDate')->name('current_report');
        });
    });

});
