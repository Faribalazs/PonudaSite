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
        if (auth()->check()) {
            $user = auth()->user();
            if (!$user->hasVerifiedEmail() || $user->status == 0) {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                if(!$user->hasVerifiedEmail()){
                    return redirect()->route('login')->with('error', 'Molimo Vas, potvrdite Vašu email adresu.');
                }
                else{
                    return redirect()->route('login')->with('error', 'Vaš nalog je suspendovan, molimo Vas kontaktirajte administratora.');
                }
            }
        }
        elseif (auth('worker')->check()) {
            $worker = auth('worker')->user();
            if (!$worker->hasVerifiedEmail() || $worker->status == 0 || in_array($worker->accepted, [0, -1])) {
                auth('worker')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            
                if (!$worker->hasVerifiedEmail()) {
                    return redirect()->route('worker.login')->with('error', 'Molimo Vas, potvrdite Vašu email adresu.');
                } elseif ($worker->status == 0) {
                    return redirect()->route('worker.login')->with('error', 'Vaš nalog je suspendovan, molimo Vas kontaktirajte administratora.');
                } else {
                    return redirect()->route('worker.login')->with('error', 'Vaš nalog još uvek nije potvrđen.');
                }                
            }            
        }

        return $next($request);
    }
}
