<?php

namespace App\Http\Controllers\Workerauth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->guard('worker')->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('worker.myprofile'));
        }

        $request->guard('worker')->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
