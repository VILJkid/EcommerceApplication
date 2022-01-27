<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActiveSession
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
        // This middleware will redirect every guest to the login page.
        if (!empty($sid = session('sid'))) {
            return $next($request);
        } else {
            return redirect("/login");
        }
    }
}
