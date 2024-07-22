<?php

namespace App\Repositories\Authentication;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationRepository implements AuthenticationRepositoryInterface
{
    /**
     * @param array $parameters
     * @return array
     * @throws ValidationException
     */
    public function login(array $parameters): array
    {
        /** @var User $user */
        $user = User::query()->where('email', $parameters['email'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => __('validation.exists', ['attribute' => __('validation.attributes.email')])
            ]);
        } elseif (!$user->hasRoles('panel')) {
            throw ValidationException::withMessages([
                'email' => __('validation.exists', ['attribute' => __('validation.attributes.email')])
            ]);
        } elseif (!Hash::check($parameters['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => __('validation.exists', ['attribute' => __('validation.attributes.password')])
            ]);
        }

        return $this->getToken($user);
    }

    private function getToken(User $user): array
    {
        $token = $user->createToken('panel');
        return [
            'token' => $token->plainTextToken,
        ];
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        /** @var User $token */
        $user = auth()->user();
        $token = $user->currentAccessToken();
        $token->delete();
    }

    /**
     * @param array $parameters
     * @return User
     * @throws ValidationException
     */
    public function forget(array $parameters): User
    {
        $email = $parameters['email'];

        /** @var User $user */
        $user = User::query()->where('email', $email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => __('validation.invalid', ['attribute' => __('validation.attributes.email')])
            ]);
        }

        return $user;
    }

    /**
     * @throws ValidationException
     */
    public function setPassword(array $parameters): array
    {
        $email = decrypt($parameters['code']);

        /** @var User $user */
        $user = User::query()
            ->where('email', $email)
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => __('validation.invalid', ['attribute' => __('validation.attributes.mobile')])
            ]);
        }

        $user->update([
            'password' => Hash::make($parameters['password']),
        ]);

        return $this->getToken($user);
    }

    /**
     * @param array $parameters
     * @return bool
     * @throws ValidationException
     */
    public function changePassword(array $parameters): bool
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->password) {
            if (!Hash::check($parameters['current_password'], $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => __('validation.invalid', ['attribute' => __('validation.attributes.current_password')])
                ]);
            }
        }

        return $user->update([
            'password' => Hash::make($parameters['password']),
        ]);
    }

    public function update(array $parameters): User
    {
        /** @var User $user */
        $user = auth()->user();
        $user->update($parameters);

        return $user->refresh();
    }

    public function profile(): User
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->refresh();
    }
}
