<?php

Route::get('/', 'AuthController@login');
Route::post('/login', 'AuthController@loginPost');
Route::post('logout', 'AuthController@logout');

Route::get('email', 'AuthController@email');



Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('inicio', 'DashboardController@index');
    Route::get('calendario', 'CalendarController@index');
    Route::resource('citas', 'EngagementController');
    Route::resource('sucursales', 'BranchController');
    Route::resource('clientes', 'ClientController');
    Route::resource('usuarios', 'UserController');
    Route::resource('servicios', 'ServiceController');
});
