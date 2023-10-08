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
        session(['url.intended' => url()->previous()]);
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
        $request->authenticate();

        if (session()->has('url.intended')) {
            $redirectTo = session()->get('url.intended');
            session()->forget('url.intended');
        }

        $request->session()->regenerate();


        if ($request->user('worker')->hasVerifiedEmail()) {
            if ($redirectTo) {
                return redirect($redirectTo);
            }
            return redirect()->intended(route('worker.myprofile'));
        }

        return redirect()->back();
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
