<?php

namespace Albert\Waf\Http\Middleware;

use Albert\Waf\Facades\Waf;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WafMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless(Waf::requestIsAllowed($request), 400);

        return $next($request);
    }
}
