<?php

namespace App\Modules\Auth\Domain;

use App\Models\User;

interface AuthServiceInterface
{
    public function generateToken(User $user): string;
    public function validateToken(string $token): ?User;
    public function refreshToken(string $token): string;
    public function invalidateToken(string $token): bool;
}
