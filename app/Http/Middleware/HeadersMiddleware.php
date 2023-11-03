<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //add to 'Content-Security-Policy' and fix it so local files are approved -> default-src 'self'; style-src 'self' '/css/app.css'; script-src 'self'; 
        $request->headers->set('Content-Security-Policy', "frame-src 'none';");        
        $request->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload;');
        $request->headers->set('X-Content-Type-Options', 'nosniff');
        $request->headers->set('X-Frame-Options','DENY');
        $request->headers->set('X-XSS-Protection','1; mode=block');
        $request->headers->set('Referrer-Policy','strict-origin-when-cross-origin');
        $request->headers->set('Pragma','no-cache');
        $request->headers->remove('Access-Control-Allow-Origin');

        // dd($request->headers->all());
        return $next($request);
    }
}
