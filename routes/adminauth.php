<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Adminauth\AuthenticatedSessionController;


Route::group(['middlewere' => ['guest:admin'],'prefix'=>'admin','as'=>'admin.'],function(){

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

});

Route::group(['middlewere' => ['auth:admin'],'prefix'=>'admin','as'=>'admin.'],function(){

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->name('logout');

    Route::get('/profile', [AdminController::class, 'create'])
                    ->name('profile');

});