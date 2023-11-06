<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        try{
            $user = User::findOrFail($request->route('id'));
        } catch (ModelNotFoundException) {
            alert()->error('Nešto nije u redu. Pokušajte ponovo kasnije ili kontaktirajte administratora.')->showCloseButton()->showConfirmButton(__('app.basic.close'));
            return redirect()->intended(route('register'));
        }

        if (! hash_equals(sha1($user->getEmailForVerification()), (string) $request->route('hash'))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            alert()->success('Vaša email adresa je uspešno verifikovana.')->showCloseButton()->showConfirmButton(__('app.basic.close'));
            return redirect()->intended(route('home'));
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        alert()->success('Vaša email adresa je uspešno verifikovana.')->showCloseButton()->showConfirmButton(__('app.basic.close'));
        return redirect()->intended(route('home'));
    }
}
