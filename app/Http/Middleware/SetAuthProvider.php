<?php

namespace App\Http\Middleware;

use Closure;

class SetAuthProvider
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $provider)
    {
        config(['auth.guards.api.provider' => $provider]);
        return $next($request);
    }
}
