<?php

namespace App\Modules\Client\Services\Authentication;

use App\Modules\Core\Models\User;

interface AuthenticationServiceInterface
{
    public function check(array $parameters): array;

    public function otp(array $parameters): array;

    public function login(array $parameters): array;

    public function logout(): void;

    public function forget(array $parameters): array;

    public function reset(array $parameters): array;

    public function changePassword(array $parameters): User;

    public function setPassword(array $parameters);

    public function update(array $parameters): User;

    public function profile(): User;


}
