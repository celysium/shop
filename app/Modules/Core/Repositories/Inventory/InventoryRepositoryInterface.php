<?php

namespace App\Modules\Core\Repositories\Inventory;

use App\Modules\Core\Models\Inventory;
use App\Modules\Core\Models\Product;
use Celysium\Helper\Contracts\BaseRepositoryInterface;

interface InventoryRepositoryInterface extends BaseRepositoryInterface
{
    public function strategySelectHead(Product $product): Inventory;

}
