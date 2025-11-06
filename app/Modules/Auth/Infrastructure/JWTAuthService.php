<?php

namespace App\Modules\Auth\Infrastructure;

use App\Models\User;
use App\Modules\Auth\Domain\AuthServiceInterface;
use App\Modules\User\Domain\UserRepositoryImplementation;
use App\Modules\User\Infrastructure\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthService implements AuthServiceInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepositoryImplementation $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function generateToken(User $user): string
    {
        $claims = ['sub' => $user->id, 'email' => $user->email, 'name' => $user->name];
        return JWTAuth::claims($claims)->fromUser($user);
    }

    public function validateToken(string $token): ?User
    {
        try {
            $payload = JWTAuth::setToken($token)->getPayload();
            $userId = $payload->get('sub');
            return $this->userRepository->findUserById($userId);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function refreshToken(string $token): string
    {
        try {
            $newToken = JWTAuth::setToken($token)->refresh();
            return $newToken;
        } catch (\Exception $e) {
            throw new \RuntimeException('Could not refresh token: ' . $e->getMessage());
        }
    }

    public function invalidateToken(string $token): bool
    {
        try {
            JWTAuth::setToken($token)->invalidate();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
