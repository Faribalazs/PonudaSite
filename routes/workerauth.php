<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Workerauth\GoogleSocialiteController;
use App\Http\Controllers\Workerauth\NewPasswordController;
use App\Http\Controllers\Workerauth\VerifyEmailController;
use App\Http\Controllers\Workerauth\RegisteredUserController;
use App\Http\Controllers\Workerauth\PasswordResetLinkController;
use App\Http\Controllers\Workerauth\ConfirmablePasswordController;
use App\Http\Controllers\Workerauth\AuthenticatedSessionController;
use App\Http\Controllers\Workerauth\EmailVerificationPromptController;
use App\Http\Controllers\Workerauth\EmailVerificationNotificationController;

//Google
Route::get('contractor/auth/google', [GoogleSocialiteController::class, 'redirectToGoogle'])->name('worker.login.google');
Route::get('contractor/callback/google', [GoogleSocialiteController::class, 'handleCallback'])->name('worker.callback.google');

Route::group(['middlewere' => ['guest:worker'],'prefix'=>'contractor','as'=>'worker.'],function(){

    Route::get('/register', [RegisteredUserController::class, 'create'])
                    ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                    ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                    ->middleware('guest');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                    ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                    ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                    ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
                    ->name('password.update');
});

Route::group(['middleware' => ['auth:worker'],'prefix'=>'contractor','as'=>'worker.'],function(){

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                    ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware(['signed', 'throttle:6,1'])
                    ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware(['throttle:6,1'])
                    ->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                    ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->name('logout');

});
