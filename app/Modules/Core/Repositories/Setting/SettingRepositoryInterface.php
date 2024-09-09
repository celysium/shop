<?php

namespace App\Modules\Core\Repositories\Setting;

use Celysium\Helper\Contracts\BaseRepositoryInterface;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{
    public function value(string $key, mixed $default = null): mixed;
}
