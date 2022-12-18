<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AcceptJson
{
    public function handle(Request $request, Closure $next): mixed
    {
        $request->headers->set('Accept', 'Application/json');

        return $next($request);
    }
}
