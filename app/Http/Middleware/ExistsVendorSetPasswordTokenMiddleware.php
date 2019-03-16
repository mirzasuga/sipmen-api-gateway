<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class ExistsVendorSetPasswordTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $vendorId = $request->route('vendorId');
        $token = $request->route('token');

        $redisToken = Redis::get("vendors:$vendorId:token");

        if (!$redisToken) {
            return response()->json([
                'message' => 'token not found',
                'status_code' => 404
            ], 404);
        }

        if( $token !== $redisToken ) {
            return response()->json([
                'message' => 'token not Valid',
                'status_code' => 401
            ], 401);
        }

        return $next($request);
    }
}
