<?php

namespace App\Modules\Core\Repositories\OrderItem;

use App\Modules\Core\Models\OrderItem;
use Celysium\Helper\Repository\BaseRepository;

class OrderItemRepository extends BaseRepository
{
    protected static string $entity = OrderItem::class;
}
