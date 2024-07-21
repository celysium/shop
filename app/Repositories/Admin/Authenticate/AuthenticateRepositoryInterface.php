<?php

namespace App\Repositories\Admin\Authenticate;

use App\Models\User;

interface AuthenticateRepositoryInterface
{
    public function login(array $parameters): array;

    public function logout(User $user): void;

}
