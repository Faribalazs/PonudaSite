<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = null;
        if (auth()->check()) {
            $user = auth();
            $route = 'login';
        }
        elseif(auth('worker')->check()){
            $user = auth('worker');
            $route = 'worker.login';
        }
        if(isset($user))
        {
            $userdata = $user->user();
            if (!$userdata->hasVerifiedEmail() || $userdata->status == 0) {
                $user->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                if(!$userdata->hasVerifiedEmail()){
                    return redirect()->route($route)->with('error', 'Molimo Vas, potvrdite Vašu email adresu.');
                }
                else{
                    return redirect()->route($route)->with('error', 'Vaš nalog je suspendovan, molimo Vas kontaktirajte administratora.');
                }
            }
        }

        return $next($request);
    }
}
