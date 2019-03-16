<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ConsumeExternalApi;

class VerifyUserBranch
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
        $request->validate([
            'role_vendor_id' => 'required'
        ]);

        if(!RoleVendor::exists($request->role_vendor_id)) {
            return response()->json([
                'message' => 'Data yang diberikan tidak valid',
                'errors' => [
                    'role_vendor_id' => [
                        'role vendor id tidak ditemukan'
                    ]
                ]
            ], 422);
        }
        return $next($request);
    }
}
