<?php

namespace App\Modules\Core\Repositories\Location;

use App\Modules\Core\Models\Location;
use Celysium\Helper\Repository\BaseRepository;

class LocationRepository extends BaseRepository
{
    protected static string $entity = Location::class;
}
