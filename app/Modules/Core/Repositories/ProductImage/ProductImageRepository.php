<?php

namespace App\Modules\Core\Repositories\ProductImage;

use App\Modules\Core\Models\ProductImage;
use Celysium\Helper\Repository\BaseRepository;

class ProductImageRepository extends BaseRepository implements ProductImageRepositoryInterface
{
    protected static string $entity = ProductImage::class;
}
