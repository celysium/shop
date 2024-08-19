<?php

namespace App\Modules\Core\Repositories\Banner;

use App\Modules\Core\Models\Banner;
use Celysium\Helper\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    protected static string $entity = Banner::class;

    public function conditions(Builder $query): array
    {
        return [
            'slider_id' => '=',
            'title'     => 'like',
        ];
    }
}
