<?php

namespace App\Modules\Core\Repositories\Product;

use App\Modules\Core\Models\Product;
use Celysium\Helper\Repository\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected static string $entity = Product::class;
}
