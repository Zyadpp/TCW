<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $isAdmin = (bool) $request->session()->get('is_admin')
            || (Auth::check() && strcasecmp((string) Auth::user()->role, 'admin') === 0);

        if (! $isAdmin) {
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Please log in to access the admin.']);
        }

        return $next($request);
    }
}
