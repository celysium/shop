<?php

namespace App\Repositories\Authentication;

use App\Models\User;

interface AuthenticationRepositoryInterface
{
    public function login(array $parameters): array;

    public function logout(): void;

    public function forget(array $parameters): User;

    public function setPassword(array $parameters);

    public function changePassword(array $parameters);

    public function update(array $parameters): User;

    public function profile(): User;


}
