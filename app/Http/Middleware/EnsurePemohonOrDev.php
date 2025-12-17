<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePemohonOrDev
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Nantinya: pemohon (login)
        if (auth()->check()) {
            return $next($request);
        }

        // 2. Bypass khusus developer (LOCAL only)
        if (app()->environment('local') && $request->has('preview')) {
            return $next($request);
        }

        abort(403, 'DAFTAR O PEMOHON SEK COK!');
    }
}