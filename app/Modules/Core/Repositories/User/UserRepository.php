<?php

namespace App\Modules\Core\Repositories\User;

use App\Modules\Core\Models\User;
use Celysium\Helper\Repository\BaseRepository;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
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


    /**
     * @param User $user
     * @return void
     * @throws ValidationException
     */
    public function checkRole(User $user): void
    {
        if (!$user->hasRoles('panel')) {
            throw ValidationException::withMessages([
                'email' => __('validation.exists', ['attribute' => __('validation.attributes.email')])
            ]);
        }
    }

    public function getToken(User $user, string $name, array $abilities = ['*'], DateTimeInterface $expiresAt = null): string
    {
        $token = $user->createToken($name, $abilities, $expiresAt);
        return $token->plainTextToken;
    }

    public function deleteCurrentToken(User $user): bool
    {
        /** @var Model $token */
        $token = $user->currentAccessToken();
        return $token->delete();
    }
}
