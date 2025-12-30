<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePemohonOrDev
{
    public function handle(Request $request, Closure $next)
    {
        // DEV BYPASS — KHUSUS LOCAL
        if (app()->isLocal()) {
            return $next($request);
        }

        // USER WAJIB LOGIN (PEMOHON)
        if (!auth()->check()) {
            abort(403);
        }

        return $next($request);
    }
}