<?php

namespace App\Repositories\Admin\Authenticate;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticateRepository implements AuthenticateRepositoryInterface
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

    public function logout(User $user): void
    {
        /** @var Model $token */
        $token = $user->currentAccessToken();
        $token->delete();
    }
}
