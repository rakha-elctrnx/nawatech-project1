<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $abort = true;
        foreach($roles as $role) {
            if ($request->user()->role == $role) {
                $abort = false;
            }
        }

        if ($abort) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);

    }
}
