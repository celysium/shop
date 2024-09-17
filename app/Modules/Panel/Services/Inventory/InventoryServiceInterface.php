<?php

namespace App\Modules\Panel\Services\Inventory;


use App\Modules\Core\Models\Inventory;
use App\Modules\Core\Models\Product;
use Celysium\Helper\Contracts\BaseServiceInterface;

interface InventoryServiceInterface extends BaseServiceInterface
{
    public function selectHead(Product $product): Inventory;

}
