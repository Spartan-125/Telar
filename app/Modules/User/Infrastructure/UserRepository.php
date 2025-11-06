<?php

namespace App\Modules\User\Infrastructure;

use App\Models\User;
use App\Modules\User\Domain\UserRepositoryImplementation;

class UserRepository implements UserRepositoryImplementation
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function findUserById(int $id): ?User
    {
        return $this->model->find($id);
    }

    public function findUserByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
}
