<?php

namespace App\Http\Middleware;

use App\Modules\Auth\Application\AuthValidate;
use App\Modules\Auth\Infrastructure\JWTAuthService;
use App\Utils\CodeHttp;
use App\Utils\ResponseHttp;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $authService;

    public function __construct(JWTAuthService $authService)
    {
        $this->authService = $authService;
    }
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if (!$token) {
            return ResponseHttp::error('Unauthorized', CodeHttp::UNAUTHORIZED);
        }
        $user = (new AuthValidate())->execute($this->authService, $token);
        if (!$user) {
            return ResponseHttp::error('Unauthorized', CodeHttp::UNAUTHORIZED);
        }
        return $next($request);
    }
}
