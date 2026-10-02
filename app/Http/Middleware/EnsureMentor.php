<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureMentor
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($request->user() && strcasecmp((string) $request->user()->role, 'Mentor') === 0, 403);

        return $next($request);
    }
}
