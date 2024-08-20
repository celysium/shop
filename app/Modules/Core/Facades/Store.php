<?php

namespace App\Modules\Core\Facades;

use Illuminate\Support\Facades\Facade;
use App\Modules\Core\Models\Store as StoreModel;

/**
 * @method static select(array $conditions = []): StoreModel
 */
class Store extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'store-repository';
    }
}
