<?php

namespace App\Modules\Core\Repositories\Constant;

use Celysium\Helper\Contracts\BaseRepositoryInterface;

interface ConstantRepositoryInterface extends BaseRepositoryInterface
{
    public static function value(string $key, $default = null): mixed;
}
