<?php

namespace App\Modules\Core\Repositories\User;

use App\Modules\Core\Models\User;
use Celysium\Helper\Contracts\BaseRepositoryInterface;
use DateTimeInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{

    public function checkPassword(User $user, string $password): void;

    public function checkRole(User $user): void;

    public function getToken(User $user, string $name, array $abilities = ['*'], DateTimeInterface $expiresAt = null): string;

    public function deleteCurrentToken(User $user): bool;
}
