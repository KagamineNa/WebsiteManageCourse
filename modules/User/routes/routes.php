<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Modules\User\src\Http\Controllers', 'middleware' => 'web'], function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', 'UserController@index')->name('admin.user.index');
            Route::get('/create', 'UserController@create')->name('admin.user.create');
            Route::post('/create', 'UserController@store')->name('admin.user.store');
        });
    });
});
