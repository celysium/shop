<?php

namespace App\Modules\Core\Facades;

use App\Modules\Core\Models\Product;
use Illuminate\Support\Facades\Facade;
use App\Modules\Core\Models\Inventory as InventoryModel;

/**
 * @method static selectHead(Product $product): InventoryModel
 */
class Inventory extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'inventory-repository';
    }
}
