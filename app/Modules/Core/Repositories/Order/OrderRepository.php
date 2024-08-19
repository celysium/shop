<?php

namespace App\Modules\Core\Repositories\Order;

use App\Modules\Core\Models\Order;
use Celysium\Helper\Repository\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    protected static string $entity = Order::class;
}
