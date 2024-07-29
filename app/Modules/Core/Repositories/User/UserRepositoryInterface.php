<?php

namespace App\Modules\Core\Repositories\User;

use App\Modules\Core\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): User;

    public function checkPassword(User $user, string $password): void;

    public function update(User $user, array $parameters): User;

}
