<?php

namespace App\Modules\Admin\Services\Category;


use App\Modules\Core\Models\Category;
use Celysium\Helper\Contracts\BaseServiceInterface;
use Illuminate\Support\Collection;

interface CategoryServiceInterface extends BaseServiceInterface
{
    public function children(Category $category): Collection;

    public function tree(Category $category): Category;

}
