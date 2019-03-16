<?php

namespace App\Http\Middleware\Customer;

use Closure;
use App\User;

class CustomerSetClientSecretMiddleware
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
        $request->merge(['provider' => 'users']);
        $request->merge(['client_secret' => env('CUSTOMER_CLIENT_SECRET_KEY')]);
        $request->merge(['client_id' => env('CUSTOMER_CLIENT_SECRET_ID')]);

        // Try catch nya nanti pindahin di exception
        try {
            $user = User::where('email', $request->username)->first();

            if (!$user) throw new \Exception('invalid_credentials');

        } catch(\Exception $e) {

            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 401
            ], 401);

        }

        $request->merge(['scope' => ['customer']]);
        $request->merge(['user' => $user]);

        return $next($request);
    }
}
