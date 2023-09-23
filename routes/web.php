<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleSocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

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
Route::middleware(['guest'])->group(function () {
    //Google
    Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback'])->name('callback.google');
});

Route::view('/', 'home')->name('home');

//auth route for both 
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// for users
Route::group(['middleware' => ['auth', 'role:user']], function() { 
    Route::get('/profile', [DashboardController::class, 'profile'])->name('myprofile');
});


//admin
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('dashboard', 'admin.admin-dash')->name('dashboard');
    Route::get('/users', [AdminController::class, 'selectUsers'])->name('users');
    Route::put('/users/ban', [AdminController::class, 'banUser'])->name('ban.user');
    Route::put('/users/unban', [AdminController::class, 'unbanUser'])->name('unban.user');
    Route::get('/workers', [AdminController::class, 'selectWorkers'])->name('workers');
    Route::put('/workers/ban', [AdminController::class, 'banWorker'])->name('ban.worker');
    Route::put('/workers/unban', [AdminController::class, 'unbanWorker'])->name('unban.worker');
    Route::get('/categories', [AdminController::class, 'selectCategories'])->name('categories');
    Route::post('/categories/insert', [AdminController::class, 'insertCategory'])->name('insert.category');
    Route::put('/categories/edit', [AdminController::class, 'editCategory'])->name('edit.category');
    Route::delete('/categories/delete', [AdminController::class, 'deleteCategory'])->name('delete.category');
    Route::get('/subcategories', [AdminController::class, 'selectSubcategories'])->name('subcategories');
    Route::post('/subcategories/insert', [AdminController::class, 'insertSubcategory'])->name('insert.subcategory');
    Route::put('/subcategories/edit', [AdminController::class, 'editSubcategory'])->name('edit.subcategory');
    Route::delete('/subcategories/delete', [AdminController::class, 'deleteSubcategory'])->name('delete.subcategory');
    Route::get('/pozicija', [AdminController::class, 'selectPozicija'])->name('pozicija');
    Route::post('/pozicija/insert', [AdminController::class, 'insertPozicija'])->name('insert.pozicija');
    Route::put('/pozicija/edit', [AdminController::class, 'editPozicija'])->name('edit.pozicija');
    Route::delete('/pozicija/delete', [AdminController::class, 'deletePozicija'])->name('delete.pozicija');
});

require __DIR__.'/auth.php';
require __DIR__.'/adminauth.php';
require __DIR__.'/workerauth.php';
require __DIR__.'/worker.php';
