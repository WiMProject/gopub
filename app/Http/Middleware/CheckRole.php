<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pastikan user sudah login dan memiliki role yang sesuai
        if (!$request->user()) {
            abort(403, 'Unauthorized action. Please login.');
        }
        
        // Debug untuk melihat role user
        \Log::debug('User role: ' . ($request->user()->role ? $request->user()->role->name : 'no role'));
        \Log::debug('Required role: ' . $role);
        
        if (!$request->user()->hasRole($role)) {
            abort(403, 'You do not have permission to access this resource.');
        }

        return $next($request);
    }
}