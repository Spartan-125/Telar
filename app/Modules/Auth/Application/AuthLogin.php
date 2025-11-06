<?php

namespace App\Modules\Auth\Application;

use App\Models\User;
use App\Modules\Auth\Domain\AuthServiceInterface;

class AuthLogin
{
    public function execute(AuthServiceInterface $authService, User $user)
    {
        $token = $authService->generateToken($user);
        return $token;
    }
}
