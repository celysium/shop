<?php

namespace App\Modules\Core\Repositories\Delivery;

use App\Modules\Core\Models\Delivery;
use Celysium\Helper\Repository\BaseRepository;

class DeliveryRepository extends BaseRepository
{
    protected static string $entity = Delivery::class;
}
