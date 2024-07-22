<?php

namespace App\Services\Admin\Authentication;

use App\Models\User;
use App\Repositories\Authentication\AuthenticationRepositoryInterface;
use App\Repositories\OTP\OTPRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationService implements AuthenticationServiceInterface
{
    public function __construct(
        private readonly AuthenticationRepositoryInterface $authenticationRepository,
        private readonly OTPRepositoryInterface            $otpRepository
    )
    {

    }

    /**
     * @param array $parameters
     * @return array
     */
    public function login(array $parameters): array
    {
        return $this->authenticationRepository->login($parameters);
    }

    public function logout(): void
    {
        $this->authenticationRepository->logout();
    }


    /**
     * @param array $parameters
     * @return array
     */
    public function forget(array $parameters): array
    {
        $this->authenticationRepository->forget($parameters);

        $this->otpRepository->send($parameters['username']);

        return [
            'retry_time' => env('VERIFICATION_RETRY_TIME', 60)
        ];
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function reset(array $parameters): array
    {
        $this->otpRepository->check($parameters['email'], $parameters['token']);

        return [
            'token' => encrypt($parameters['email'])
        ];
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function setPassword(array $parameters): array
    {
        return $this->authenticationRepository->setPassword($parameters);
    }

    /**
     * @param array $parameters
     * @return bool
     */
    public function changePassword(array $parameters): bool
    {
        return $this->authenticationRepository->changePassword($parameters);
    }

    public function update(array $parameters): User
    {
        return $this->authenticationRepository->update($parameters);
    }

    public function profile(): User
    {
        return $this->authenticationRepository->profile();
    }

}
