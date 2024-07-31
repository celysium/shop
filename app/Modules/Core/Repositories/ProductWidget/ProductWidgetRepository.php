<?php

namespace App\Modules\Core\Repositories\ProductWidget;

use App\Modules\Core\Models\ProductWidget;
use Celysium\Helper\Repository\BaseRepository;

class ProductWidgetRepository extends BaseRepository
{
    protected static string $entity = ProductWidget::class;
}
