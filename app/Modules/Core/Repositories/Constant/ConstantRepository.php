<?php

namespace App\Modules\Core\Repositories\Constant;

use App\Modules\Core\Models\Constant;
use Celysium\Helper\Repository\BaseRepository;

class ConstantRepository extends BaseRepository
{
    protected static string $entity = Constant::class;

    public static function value(string $key, $default = null): mixed
    {
        return (new static::$entity)::query()
            ->where('key', $key)
            ->value('value')?->value ?? $default;
    }
}
