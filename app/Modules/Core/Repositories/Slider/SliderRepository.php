<?php

namespace App\Modules\Core\Repositories\Slider;

use App\Modules\Core\Models\Slider;
use App\Modules\Core\Repositories\Payment\PaymentRepositoryInterface;
use Celysium\Helper\Repository\BaseRepository;

class SliderRepository extends BaseRepository implements PaymentRepositoryInterface
{
    protected static string $entity = Slider::class;
}
