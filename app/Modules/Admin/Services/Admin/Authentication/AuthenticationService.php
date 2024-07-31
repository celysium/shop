<?php

namespace App\Modules\Admin\Services\Admin\Authentication;

use App\Modules\Core\Models\User;
use App\Modules\Core\Repositories\PasswordToken\PasswordTokenRepositoryInterface;
use App\Modules\Core\Repositories\User\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;

readonly class AuthenticationService implements AuthenticationServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PasswordTokenRepositoryInterface $passwordTokenRepository
    )
    {

    }

    /**
     * @param array $parameters
     * @return array
     * @throws ValidationException
     */
    public function login(array $parameters): array
    {
        /** @var User $user */
        $user = $this->userRepository->findByField('email', $parameters['email']);

        $this->checkRole($user);

        $this->userRepository->checkPassword($user, $parameters['password']);

        return $this->getToken($user);
    }

    /**
     * @param User $user
     * @return void
     * @throws ValidationException
     */
    private function checkRole(User $user): void
    {
        if (!$user->hasRoles('panel')) {
            throw ValidationException::withMessages([
                'email' => __('validation.exists', ['attribute' => __('validation.attributes.email')])
            ]);
        }
    }

    private function getToken(User $user): array
    {
        $token = $user->createToken('panel');
        return [
            'token' => $token->plainTextToken,
        ];
    }

    public function logout(): void
    {
        /** @var User $token */
        $user = auth()->user();
        $token = $user->currentAccessToken();
        $token->delete();
    }


    /**
     * @param array $parameters
     * @return array
     */
    public function forget(array $parameters): array
    {
        $this->passwordTokenRepository->send($parameters['email']);

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
        $this->passwordTokenRepository->check($parameters['email'], $parameters['token']);

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

        return $this->getToken($user);
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
