<?php

namespace App\Modules\Core\Repositories\Cart;

use App\Modules\Core\Models\Cart;
use Celysium\Helper\Repository\BaseRepository;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    protected static string $entity = Cart::class;
}
