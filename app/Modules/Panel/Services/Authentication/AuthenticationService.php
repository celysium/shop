<?php

namespace App\Modules\Panel\Services\Authentication;

use App\Modules\Core\Models\User;
use App\Modules\Core\Repositories\PasswordToken\PasswordTokenRepositoryInterface;
use App\Modules\Core\Repositories\User\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;

readonly class AuthenticationService implements AuthenticationServiceInterface
{
    public function __construct(
        private UserRepositoryInterface          $userRepository,
        private PasswordTokenRepositoryInterface $passwordTokenRepository
    )
    {

    }

    /**
     * @param array $parameters
     * @return array
     */
    public function check(array $parameters): array
    {
        /** @var User $user */
        $user = $this->userRepository->findByField('mobile', $parameters['mobile']);

        $this->userRepository->checkRole($user);

        $this->passwordTokenRepository->send($parameters['mobile']);

        return [
            'mobile'       => $user->mobile,
            'has_password' => (bool)$user->password,
            'retry_time'   => setting('core.auth.retry_time', 60),
        ];
    }

    /**
     * @param array $parameters
     * @return array
     * @throws ValidationException
     */
    public function otp(array $parameters): array
    {
        $result = $this->passwordTokenRepository->check($parameters['mobile'], $parameters['token']);
        if (!$result) {
            throw ValidationException::withMessages([
                'token' => __('validation.exists', ['attribute' => __('validation.attributes.password')])
            ]);
        }

        /** @var User $user */
        $user = $this->userRepository->findByField('mobile', $parameters['mobile']);

        $this->userRepository->checkRole($user);

        return [
            'token' => $this->userRepository->getToken($user, 'panel'),
        ];
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function login(array $parameters): array
    {
        /** @var User $user */
        $user = $this->userRepository->findByField('email', $parameters['email']);

        $this->userRepository->checkRole($user);

        $this->userRepository->checkPassword($user, $parameters['password']);

        return [
            'token' => $this->userRepository->getToken($user, 'panel'),
        ];
    }

    public function logout(): void
    {
        /** @var User $user */
        $user = auth()->user();

        $this->userRepository->deleteCurrentToken($user);
    }


    /**
     * @param array $parameters
     * @return array
     */
    public function forget(array $parameters): array
    {
        $this->passwordTokenRepository->send($parameters['email']);

        return [
            'email'      => $parameters['email'],
            'retry_time' => setting('core.auth.retry_time', 60),
        ];
    }

    /**
     * @param array $parameters
     * @return array
     * @throws ValidationException
     */
    public function reset(array $parameters): array
    {
        $result = $this->passwordTokenRepository->check($parameters['email'], $parameters['token']);
        if (!$result) {
            throw ValidationException::withMessages([
                'token' => __('validation.exists', ['attribute' => __('validation.attributes.password')])
            ]);
        }
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
        /** @var User $user */
        $user = $this->userRepository->findByField('email', decrypt($parameters['token']));

        /** @var User $user */
        $user = $this->userRepository->update($user, $parameters);

        return [
            'token' => $this->userRepository->getToken($user, 'panel'),
        ];
    }

    /**
     * @param array $parameters
     * @return User
     */
    public function changePassword(array $parameters): User
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->password) {
            $this->userRepository->checkPassword($user, $parameters['current_password']);
        }

        /** @var User $user */
        $user = $this->userRepository->update($user, $parameters);
        return $user;
    }

    public function update(array $parameters): User
    {
        /** @var User $user */
        $user = auth()->user();

        /** @var User $user */
        $user = $this->userRepository->update($user, $parameters);
        return $user;
    }

    public function profile(): User
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->refresh();
    }

}
