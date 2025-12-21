<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Redirect admin van student routes naar admin dashboard
            if ($request->is('keuzedelen*') || $request->is('dashboard') || $request->is('notificaties*')) {
                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}
