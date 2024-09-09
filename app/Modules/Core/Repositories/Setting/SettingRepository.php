<?php

namespace App\Modules\Core\Repositories\Setting;

use App\Modules\Core\Models\Setting;
use Celysium\Helper\Repository\BaseRepository;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    protected static string $entity = Setting::class;

    public function value(string $key, mixed $default = null): mixed
    {
        /** @var Setting $setting */
        $setting = (new static::$entity)::query()
            ->where('key', $key)
            ->first('value');

        return $setting?->value ?? $default;
    }
}
