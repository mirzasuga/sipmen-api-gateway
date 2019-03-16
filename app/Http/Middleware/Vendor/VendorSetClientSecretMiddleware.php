<?php

namespace App\Http\Middleware\Vendor;

use Closure;
use App\Vendor;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VendorSetClientSecretMiddleware
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
            'username' => 'required',
            'password' => 'required'
        ]);

        $request->merge(['grant_type' => 'password']);
        $request->merge(['provider' => 'vendors']);
        $request->merge(['client_secret' => env('VENDOR_CLIENT_SECRET_KEY')]);
        $request->merge(['client_id' => env('VENDOR_CLIENT_SECRET_ID')]);

        // Try catch nya nanti pindahin di exception
        try {
            $user = Vendor::where('email', $request->username)->first();
            if(!$user) {
                return response()->json([
                    'error' => 'Email atau Password salah!',
                    'status_code' => $user
                ], 401);
            }
            // if (!$user) throw new NotFoundHttpException('Username or password invalid');

        } catch(\NotFoundHttpException $e) {

            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 401
            ], 401);

        }

        $roles = $user->roles()->get();
        $scopes = $roles->pluck('name')->toArray();
        $request->merge(['scope' => $scopes]);
        $request->merge(['user' => $user]);

        return $next($request);
    }
}
