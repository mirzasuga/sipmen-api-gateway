<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ApiResponser;
use App\Services\TarifService;
use Log;
class FindTarifMiddleware
{
    use ApiResponser;

    protected $tarifService;

    public function __construct(TarifService $tarifService) {

        $this->tarifService = $tarifService;

    }


    public function handle($request, Closure $next)
    {
        try {

            $tarifResponse = $this->tarifService->obtainFindTarifById($request->vendor_tarif_id);
            $tarif = json_decode($tarifResponse);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return $this->errorResponse( 'Terjadi kesalahan server', $e->getCode());

        }

        if( $tarif->status_code === 404 ) {
            return $this->errorResponse($tarif->message, $tarif->status_code);
        }

        $request->merge(['Tarif' => $tarif->data]);

        return $next($request);
    }
}
