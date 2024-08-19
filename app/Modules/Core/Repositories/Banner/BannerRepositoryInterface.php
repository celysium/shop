<?php

namespace App\Modules\Core\Repositories\Banner;

use Celysium\Helper\Contracts\BaseRepositoryInterface;

interface BannerRepositoryInterface extends BaseRepositoryInterface
{
    public static function rearrangePosition(array &$parameters, int $currentPosition = null): void;
}
