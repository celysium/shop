<?php

namespace App\Modules\Core\Repositories\PasswordToken;

interface PasswordTokenRepositoryInterface
{
    public function send(string $username): void;

    public function check(string $username, string $token): void;


}
