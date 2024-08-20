<?php

namespace App\Modules\Core\Repositories\Store;

use App\Modules\Core\Models\Store;
use Celysium\Helper\Contracts\BaseRepositoryInterface;

interface StoreRepositoryInterface extends BaseRepositoryInterface
{
    public function select(array $conditions = []): ?Store;

}
