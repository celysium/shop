<?php

namespace App\Modules\Core\Repositories\Category;

use App\Modules\Core\Models\Category;
use Celysium\Helper\Contracts\BaseRepositoryInterface;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function children(Category $category): Collection;

    public function tree(Category $category, array $conditions = []): Category;
}
