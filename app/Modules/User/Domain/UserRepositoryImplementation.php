<?php

namespace App\Modules\User\Domain;

use App\Models\User;

interface UserRepositoryImplementation
{
    public function findUserById(int $id): ?User;
    public function findUserByEmail(string $email): ?User;
}
