<?php

namespace App\Modules\Core\Repositories\User;

use App\Modules\Core\Models\User;
use Celysium\Helper\Repository\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected static string $entity = User::class;

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
}
