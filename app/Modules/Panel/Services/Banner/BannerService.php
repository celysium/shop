<?php

namespace App\Modules\Panel\Services\Banner;

use App\Modules\Core\Repositories\Banner\BannerRepositoryInterface;
use Celysium\Helper\Service\BaseService;

class BannerService extends BaseService implements BannerServiceInterface
{
    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        parent::__construct($bannerRepository);
    }
}
