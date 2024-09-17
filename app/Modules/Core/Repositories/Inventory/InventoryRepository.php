<?php

namespace App\Modules\Core\Repositories\Inventory;

use App\Modules\Core\Models\Inventory;
use App\Modules\Core\Models\Product;
use Celysium\Helper\Repository\BaseRepository;

class InventoryRepository extends BaseRepository implements InventoryRepositoryInterface
{
    protected static string $entity = Inventory::class;

    public function strategySelectHead(Product $product): Inventory
    {
        /** @var Inventory $inventory */
        $inventory = $product->inventories()
            ->orderBy('is_stock', 'desc')
            ->orderBy('promoted_price')
            ->orderBy('original_price')
            ->first();
        return $inventory;
    }
}
