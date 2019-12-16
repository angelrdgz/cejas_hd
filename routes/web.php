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



Route::get('/', 'AuthController@login');
Route::post('/login', 'AuthController@loginPost');
Route::post('logout', 'AuthController@logout');



Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('inicio', 'DashboardController@index');
    Route::get('calendario', 'CalendarController@index');
    Route::resource('citas', 'EngagementController');
    Route::resource('sucursales', 'BranchController');
    Route::resource('clientes', 'ClientController');
    Route::resource('usuarios', 'UserController');
});
