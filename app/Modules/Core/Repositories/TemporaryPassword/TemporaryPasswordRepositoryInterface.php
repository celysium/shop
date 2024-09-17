<?php

namespace App\Modules\Core\Repositories\TemporaryPassword;

interface TemporaryPasswordRepositoryInterface
{
    public function sendCode(string $username): void;

    public function checkCode(string $username, string $code): void;

}
