<?php

namespace App\Repositories\OTP;

use App\Models\User;

interface OTPRepositoryInterface
{
    public function send(string $username): void;

    public function check(string $username, string $token): void;


}
