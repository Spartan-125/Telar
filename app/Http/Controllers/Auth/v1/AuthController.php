<?php

namespace App\Http\Controllers\Auth\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Modules\Auth\Application\AuthLogin;
use App\Modules\User\Application\FindUserByEmail;
use App\Modules\Auth\Infrastructure\JWTAuthService;
use App\Modules\User\Infrastructure\UserRepository;
use App\Utils\CodeHttp;
use App\Utils\ResponseHttp;
use Illuminate\Http\Request;
use Response;

class AuthController extends Controller
{
    protected $authService;
    protected $userRepository;

    public function __construct(JWTAuthService $authService, UserRepository $userRepository)
    {
        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = (new FindUserByEmail())->execute($this->userRepository, $email);
        if (!$user || !password_verify($password, $user->password)) {
            return ResponseHttp::error('Invalid credentials', CodeHttp::UNAUTHORIZED);
        }
        $token = (new AuthLogin())->execute($this->authService, $user);
        $user->token = $token;
        return ResponseHttp::success(new LoginResource($user), 'Login successful', CodeHttp::OK);
    }
}
