<?php

namespace App\Modules\Core\Repositories\ProductIndex;

use App\Modules\Core\Models\ProductIndex;
use Celysium\Helper\Repository\BaseRepository;

class ProductIndexRepository extends BaseRepository
{
    protected static string $entity = ProductIndex::class;
}
