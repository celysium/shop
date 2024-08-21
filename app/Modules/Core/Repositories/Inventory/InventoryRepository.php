<?php

namespace App\Modules\Core\Repositories\Inventory;

use App\Modules\Core\Facades\Store;
use App\Modules\Core\Models\Inventory;
use App\Modules\Core\Models\Product;
use Celysium\Helper\Repository\BaseRepository;

class InventoryRepository extends BaseRepository implements InventoryRepositoryInterface
{
    protected static string $entity = Inventory::class;

    public function selectHead(Product $product): Inventory
    {
        $store = Store::select();

        if ($product->inventories()->count() == 0) {
            $inventory = parent::store([
                'product_id' => $product->id,
                'store_id'   => $store->id,
            ]);
        } else {
            $inventory = $this->strategySelectHead($product);
        }
        /** @var Inventory $inventory */
        return $inventory;
    }

    protected function strategySelectHead(Product $product): Inventory
    {
        /** @var Inventory $inventory */
        $inventory = $product->inventories()
            ->orderBy('is_stock', 'desc')
            ->orderBy('promoted_price', 'desc')
            ->orderBy('original_price', 'desc')
            ->first();
        return $inventory;
    }
}
