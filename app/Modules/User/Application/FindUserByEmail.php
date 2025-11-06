<?php

namespace App\Modules\User\Application;

use App\Models\User;
use App\Modules\User\Domain\UserRepositoryImplementation;

class FindUserByEmail
{
    public function execute(UserRepositoryImplementation $userRepository, string $email): ?User
    {
        return $userRepository->findUserByEmail($email);
    }
}
