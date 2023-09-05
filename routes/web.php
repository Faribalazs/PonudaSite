<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleSocialiteController;
use App\Http\Controllers\DashboardController;

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
//Google
Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle'])->name('login.google');
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback'])->name('callback.google');

Route::get('/', function () {
    return view('home');
})->name('home');

//auth route for both 
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// for users
Route::group(['middleware' => ['auth', 'role:user']], function() { 
    Route::get('/profile', [DashboardController::class, 'profile'])->name('myprofile');
});

Route::get('/admin/dashboard', function () {
    return view('admin.admin-dash');
})->middleware(['auth:admin'])->name('admin.dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/adminauth.php';
require __DIR__.'/workerauth.php';
require __DIR__.'/worker.php';
