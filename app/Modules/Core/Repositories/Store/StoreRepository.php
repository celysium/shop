<?php

namespace App\Modules\Core\Repositories\Store;

use App\Modules\Core\Models\Store;
use Celysium\Helper\Repository\BaseRepository;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface
{
    protected static string $entity = Store::class;

    public function select(array $conditions = []): ?Store
    {
        return $this->model->query()->where($conditions)->first();
    }
}
