<?php

namespace App\Modules\Panel\Services\Inventory;

use App\Modules\Core\Models\Inventory;
use App\Modules\Core\Models\Product;
use App\Modules\Core\Repositories\Inventory\InventoryRepositoryInterface;
use App\Modules\Core\Repositories\Store\StoreRepositoryInterface;
use Celysium\Helper\Service\BaseService;

class InventoryService extends BaseService implements InventoryServiceInterface
{
    public function __construct(
        protected InventoryRepositoryInterface $inventoryRepository,
        protected StoreRepositoryInterface     $storeRepository
    )
    {
        parent::__construct($inventoryRepository);
    }

    public function selectHead(Product $product): Inventory
    {
        $store = $this->storeRepository->select();

        if ($product->inventories()->count() == 0) {
            $inventory = parent::store([
                'product_id' => $product->id,
                'store_id'   => $store->id,
            ]);
        } else {
            $inventory = $this->inventoryRepository->strategySelectHead($product);
        }
        /** @var Inventory $inventory */
        return $inventory;
    }
}
