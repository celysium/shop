<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): User;

    public function checkPassword(User $user, string $password): void;

    public function update(User $user, array $parameters): User;

}
