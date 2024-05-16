<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/', 'DashBoardController@index')->name('admin.dashboard');
});
