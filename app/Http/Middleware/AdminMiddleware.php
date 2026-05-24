<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * handle auth is_admin == false
         * redirect ke login user
         */
        if (!auth()->user() || !auth()->user()->is_admin) {
            auth()->logout();

            return redirect('/login');
        }
        return $next($request);
    }
}
