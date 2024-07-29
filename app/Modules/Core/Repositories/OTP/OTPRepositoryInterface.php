<?php

namespace App\Modules\Core\Repositories\OTP;

interface OTPRepositoryInterface
{
    public function send(string $username): void;

    public function check(string $username, string $token): void;


}
