<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RestrictUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (count($this->requestId($request->route('id')))<1) {
            return response(view('unauthorizedAction'))->header('Refresh', '2; url=/'); // url=' . redirect()->back()->getTargetUrl()
        }

        return $next($request);
    }
    private function requestId($id)
    {
        return DB::select('select ponuda_id from ponuda where ponuda_id = ? and worker_id = ?', [$id, Auth::guard('worker')->user()->id]);
    }
}
