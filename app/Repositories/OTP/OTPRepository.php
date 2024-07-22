<?php

namespace App\Repositories\OTP;

use App\Jobs\SendOTPJob;
use App\Models\PasswordToken;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class OTPRepository implements OTPRepositoryInterface
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
            if (now()->lte($passwordToken->sent_at->addSeconds(env('VERIFICATION_RETRY_TIME', 60)))) {
                $passwordToken->query()->increment('tries');
                throw new TooManyRequestsHttpException();
            }
            if ($passwordToken->tries > env('VERIFICATION_MAX_RETRY', 10)) {
                $passwordToken->query()->increment('tries');
                throw new TooManyRequestsHttpException();
            }

            if (now()->gt($passwordToken->sent_at->addSeconds(env('VERIFICATION_CODE_LIFETIME', 600)))) {
                $passwordToken->token = $this->getToken();
            }

        } else {
            $passwordToken = new PasswordToken();
            $passwordToken->token = $this->getToken();
        }
        $passwordToken->username = $username;
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
        if ($token != env('VERIFICATION_DEFAULT_CODE') || $passwordToken->token != $token) {
            throw ValidationException::withMessages(['token' => __('validation.exists', ['attribute' => __('validation.attributes.password')])]);
        }
        $passwordToken->delete();
    }

}
