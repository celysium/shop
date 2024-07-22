<?php

namespace App\Services\Admin\Authentication;

use App\Models\User;

interface AuthenticationServiceInterface
{
    public function login(array $parameters): array;

    public function logout(): void;

    public function forget(array $parameters): array;

    public function reset(array $parameters): array;

    public function changePassword(array $parameters);

    public function setPassword(array $parameters);

    public function update(array $parameters): User;

    public function profile(): User;


}
