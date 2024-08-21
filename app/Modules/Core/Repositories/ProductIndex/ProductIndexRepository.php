<?php

namespace App\Modules\Core\Repositories\ProductIndex;

use App\Modules\Core\Facades\Inventory;
use App\Modules\Core\Models\Product;
use App\Modules\Core\Models\ProductIndex;
use Celysium\Helper\Repository\BaseRepository;

class ProductIndexRepository extends BaseRepository implements ProductIndexRepositoryInterface
{
    protected static string $entity = ProductIndex::class;

    public function mapper(Product $product): ProductIndex
    {
        $inventory = Inventory::selectHead($product);
        $product = $product->refresh();
        /** @var ProductIndex $productIndex */
        $productIndex = $this->model->query()->updateOrCreate([
            'product_id' => $product->id,
        ], [
            'name'                  => $product->name,
            'sku'                   => $product->sku,
            'slug'                  => $product->slug,
            'description'           => $product->description,
            'type'                  => $product->type->value,
            'status'                => $product->status,
            'visibility'            => $product->visibility,
            'images'                => $product->images->pluck('path')->toArray(),
            'categories'            => $product->categories->toArray(),
            'store_id'              => $inventory->store_id,
            'is_stock'              => $inventory->is_stock,
            'quantity'              => $inventory->quantity,
            'buy_price'             => $inventory->buy_price,
            'original_price'        => $inventory->original_price,
            'promoted_price'        => $inventory->promoted_price,
            'promoted_activated_at' => $inventory->promoted_activated_at,
            'promoted_expired_at'   => $inventory->promoted_expired_at,
            'stores'                => $product->stores->toArray(),
        ]);

        return $productIndex;
    }
}
