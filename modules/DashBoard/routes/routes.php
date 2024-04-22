<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Modules\DashBoard\src\Http\Controllers'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', 'DashBoardController@index')->name('admin.dashboard');
    });
});
