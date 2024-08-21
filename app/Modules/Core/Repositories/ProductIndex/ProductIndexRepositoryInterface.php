<?php

namespace App\Modules\Core\Repositories\ProductIndex;

use App\Modules\Core\Models\Product;
use App\Modules\Core\Models\ProductIndex;
use Celysium\Helper\Contracts\BaseRepositoryInterface;

interface ProductIndexRepositoryInterface extends BaseRepositoryInterface
{
    public function mapper(Product $product): ProductIndex;

}
