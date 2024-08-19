<?php

namespace App\Modules\Core\Repositories\Address;

use App\Modules\Core\Models\Address;
use Celysium\Helper\Repository\BaseRepository;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    protected static string $entity = Address::class;
}
