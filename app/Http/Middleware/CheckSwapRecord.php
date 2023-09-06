<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Swap;

class CheckSwapRecord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth('worker')->check())
        {
            if(Swap::where('worker_id', auth('worker')->user()->id)->first())
            {
                return redirect()->route('worker.new.ponuda')->with('accessDenied', 'Morate završiti uređivanje ponude pre nego što pristupite ovoj stranici.');
            }
        }
        return $next($request);
    }
}
