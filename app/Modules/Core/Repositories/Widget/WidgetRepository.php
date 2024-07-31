<?php

namespace App\Modules\Core\Repositories\Widget;

use App\Modules\Core\Models\Widget;
use Celysium\Helper\Repository\BaseRepository;

class WidgetRepository extends BaseRepository
{
    protected static string $entity = Widget::class;
}
