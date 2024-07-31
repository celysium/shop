<?php

namespace App\Modules\Core\Repositories\Banner;

use App\Modules\Core\Models\Banner;
use Celysium\Helper\Repository\BaseRepository;

class BannerRepository extends BaseRepository
{
    protected static string $entity = Banner::class;
}
