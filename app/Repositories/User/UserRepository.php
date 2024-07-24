<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User
    {
        /** @var User $user */
        $user = User::query()->where('email', $email)->first();
        return $user;
    }

    /**
     * @param User $user
     * @param string $password
     * @return void
     * @throws ValidationException
     */
    public function checkPassword(User $user, string $password): void
    {
        if (!Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => __('validation.exists', ['attribute' => __('validation.attributes.password')])
            ]);
        }
    }

    public function update(User $user, array $parameters): User
    {
        $user->update($parameters);

        return $user->refresh();
    }
}
