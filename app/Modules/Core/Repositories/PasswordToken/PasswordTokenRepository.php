<?php

namespace App\Modules\Core\Repositories\PasswordToken;

use App\Modules\Panel\Jobs\SendOTPJob;
use App\Modules\Core\Models\PasswordToken;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class PasswordTokenRepository implements PasswordTokenRepositoryInterface
{
    /**
     * @param string $username
     * @return void
     */
    public function send(string $username): void
    {
        /** @var PasswordToken $passwordToken */
        $passwordToken = PasswordToken::query()->where('username', $username)->first();

        if ($passwordToken) {
            if (now()->lte($passwordToken->sent_at->addSeconds(config('core.auth.retry_time')))) {
                $passwordToken->query()->increment('tries');
                throw new TooManyRequestsHttpException();
            }
            if ($passwordToken->tries > config('core.auth.max_retry')) {
                $passwordToken->query()->increment('tries');
                throw new TooManyRequestsHttpException();
            }

            if (now()->gt($passwordToken->sent_at->addSeconds(config('core.auth.code_lifetime')))) {
                $passwordToken->token = $this->getToken();
            }

        } else {
            $passwordToken = new PasswordToken();
            $passwordToken->username = $username;
            $passwordToken->token = $this->getToken();
        }
        $passwordToken->sent_at = now();
        $passwordToken->tries++;
        $passwordToken->save();

        dispatch(new SendOTPJob($passwordToken));
    }

    private function getToken(): int
    {
        return rand(1000, 9999);
    }

    /**
     * @param string $username
     * @param string $token
     * @return void
     * @throws ValidationException
     */
    public function check(string $username, string $token): void
    {
        /** @var PasswordToken $passwordToken */
        $passwordToken = PasswordToken::query()
            ->where('username', $username)
            ->first();
        if (!$passwordToken) {
            throw ValidationException::withMessages([
                'token' => __('validation.exists', ['attribute' => __('validation.attributes.password')])
            ]);
        }
        if ($passwordToken->token != $token) {
            throw ValidationException::withMessages(['token' => __('validation.exists', ['attribute' => __('validation.attributes.password')])]);
        }
        $passwordToken->delete();
    }

}
