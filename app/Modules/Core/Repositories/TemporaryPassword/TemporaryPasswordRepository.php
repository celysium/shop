<?php

namespace App\Modules\Core\Repositories\TemporaryPassword;

use App\Modules\Panel\Jobs\SendOTPJob;
use App\Modules\Core\Models\TemporaryPassword;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class TemporaryPasswordRepository implements TemporaryPasswordRepositoryInterface
{
    /**
     * @param string $username
     * @return void
     */
    public function sendCode(string $username): void
    {
        /** @var TemporaryPassword $temporaryPassword */
        $temporaryPassword = TemporaryPassword::query()->where('username', $username)->first();

        if ($temporaryPassword) {
            if (now()->lte($temporaryPassword->sent_at->addSeconds(setting('auth.retry_time', 60)))) {
                $temporaryPassword->query()->increment('tries');
                throw new TooManyRequestsHttpException(__('auth.throttle'));
            }
            if ($temporaryPassword->tries > setting('auth.max_retry', 5)) {
                $temporaryPassword->query()->increment('tries');
                throw new TooManyRequestsHttpException(__('auth.throttle'));
            }

            if (now()->gt($temporaryPassword->sent_at->addSeconds(setting('auth.code_lifetime', 120)))) {
                $temporaryPassword->code = $this->getToken();
            }

        } else {
            $temporaryPassword = new TemporaryPassword();
            $temporaryPassword->username = $username;
            $temporaryPassword->code = $this->getToken();
        }
        $temporaryPassword->sent_at = now();
        $temporaryPassword->tries++;
        $temporaryPassword->save();

        dispatch(new SendOTPJob($temporaryPassword));
    }

    private function getToken(): int
    {
        return rand(1000, 9999);
    }

    /**
     * @param string $username
     * @param string $code
     * @return void
     * @throws ValidationException
     */
    public function checkCode(string $username, string $code): void
    {
        /** @var TemporaryPassword $temporaryPassword */
        $temporaryPassword = TemporaryPassword::query()
            ->where('username', $username)
            ->first();
        if ($temporaryPassword == null) {
            throw ValidationException::withMessages([
                'code' => __('auth.failed')
            ]);
        }
        if ($temporaryPassword->code != $code) {
            throw ValidationException::withMessages([
                'code' => __('auth.password')
            ]);
        }
        $temporaryPassword->delete();
    }

}
