<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (!auth::check()) {
            return redirect()->route('login', ['redirect' => $request->fullUrl()]);
        } elseif (!auth::check() || auth::user()->role !== $roles) {
            abort(401, 'You have not Permission to access this Page');
        }
        return $next($request);
    }
}
