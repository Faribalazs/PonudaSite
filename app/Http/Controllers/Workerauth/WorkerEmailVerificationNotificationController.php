<?php

namespace App\Http\Controllers\Workerauth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Worker;

class WorkerEmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Worker::find(decrypt($request->mama));

        if($user)
        {
            if ($user->hasVerifiedEmail()) {
                return redirect()->intended(route('worker.myprofile'));
            }

            $user->sendEmailVerificationNotification();

            toast(__('app.auth.e-mail-sent'),'success')->position('bottom')->autoClose(5000);
            return redirect()->back();
        }

        return redirect()->back()->with('error',__('Something went wrong'));
    }
}
