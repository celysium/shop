<?php

namespace App\Modules\Panel\Services\Widget;

use App\Modules\Core\Repositories\Widget\WidgetRepositoryInterface;
use Celysium\Helper\Service\BaseService;

class WidgetService extends BaseService implements WidgetServiceInterface
{
    public function __construct(WidgetRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
