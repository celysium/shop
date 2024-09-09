<?php

namespace App\Modules\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static value(string $key, mixed $default = null): mixed
 */
class Setting extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'setting-repository';
    }
}
