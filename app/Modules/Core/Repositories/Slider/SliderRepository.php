<?php

namespace App\Modules\Core\Repositories\Slider;

use App\Modules\Core\Models\Slider;
use Celysium\Helper\Repository\BaseRepository;

class SliderRepository extends BaseRepository
{
    protected static string $entity = Slider::class;
}
