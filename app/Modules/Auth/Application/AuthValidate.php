<?php

namespace App\Modules\Auth\Application;

use App\Models\User;
use App\Modules\Auth\Domain\AuthServiceInterface;

class AuthValidate
{
    public function execute(AuthServiceInterface $authService, string $token): ?User
    {
        return $authService->validateToken($token);
    }
}
