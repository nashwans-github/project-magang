<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePortalAcces
{
   public function handle($request, Closure $next)
{
    if (! session('portal_logged_in')) {
        return redirect('/login');
    }

    return $next($request);
}

}
