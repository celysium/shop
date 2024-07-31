<?php

namespace App\Modules\Core\Repositories\Inventory;

use App\Modules\Core\Models\Inventory;
use Celysium\Helper\Repository\BaseRepository;

class InventoryRepository extends BaseRepository
{
    protected static string $entity = Inventory::class;
}
