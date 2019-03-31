<?php

namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use App\Customers\Customer;
// use App\Customers\Exceptions\CustomerNotFoundException;
use App\Vendor;
use App\User;
use App\Exceptions\VendorNotFoundException;
use Illuminate\Database\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\TokenRepository;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;
use Lcobucci\JWT\Parser as JwtParser;

class VendorTokenAuthController extends AccessTokenController
{
    /**
     * Authorization server
     *
     * @var \League\OAuth2\Server\AuthorizationServer
     */
    protected $server;

    /**
     * The token repository instance.
     *
     * @var \Laravel\Passport\TokenRepository
     */
    protected $tokens;

    /**
     * The JWT parser instance.
     *
     * @var \Lcobucci\JWT\Parser
     */
    protected $jwt;

    /**
     * Create a new controller instance.
     * @param  \League\OAuth2\Server\AuthorizationServer  $server
     * @param  \Laravel\Passport\TokenRepository  $tokens
     * @param  \Lcobucci\JWT\Parser  $jwt
     */
    public function __construct( AuthorizationServer $server,
        TokenRepository $tokens,
        JwtParser $jwt
    ) {
        parent::__construct($server, $tokens, $jwt);
    }

    /**
     * Override the default Laravel Passport token generation
     *
     * @param ServerRequestInterface $request
     * @return array
     * @throws UserNotFoundException
     */

     public function issueToken( ServerRequestInterface $request ) {

        $data = $request->getParsedBody();

        $body = parent::issueToken($request)->getContent();

        $token = json_decode($body, true);

        if (array_key_exists('error', $token)) {
            return response()->json([
                'error' => $token['error'],
                'status_code' => 401
            ], 401);
        }
        $user = Vendor::where('email', $data['username'])->first();
        $vendorDetail = $user->vendorDetail()->first();
        $data = compact('token', 'user', 'vendorDetail');

        return response()->json([
            'OK' => true,
            'data' => $data
        ]);

     }
}
