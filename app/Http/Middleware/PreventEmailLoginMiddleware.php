<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventEmailLoginMiddleware
{
    protected $emails = [
        'test@bateriku.com',
        'test2@bateriku.com',
        'test3@bateriku.com',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array($request->email, $this->emails)) {
            return redirect('/login');
        }

        return $next($request);
    }
}
