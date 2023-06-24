<?php

namespace App\Http\Controllers\Workerauth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workerauth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (Auth::guard('worker')->check() || Auth::user()) {
            return redirect()->intended(route('home'));
        }
        return view('worker.auth.login');
    }

    public function loginEmail(LoginRequest $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return view('auth.verify-email');
    }
    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        if (Auth::guard('worker')->check() || Auth::user()) {
            return redirect()->intended(route('home'));
        }
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user('worker')->hasVerifiedEmail()) {
            return redirect()->intended(route('worker.myprofile'));
        } else {
            $request->user('worker')->sendEmailVerificationNotification();
            return view('worker.auth.verify-email');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('worker')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
