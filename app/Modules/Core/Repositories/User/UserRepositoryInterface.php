<?php

namespace App\Modules\Core\Repositories\User;

use App\Modules\Core\Models\User;
use Celysium\Helper\Contracts\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{

    public function checkPassword(User $user, string $password): void;

}
