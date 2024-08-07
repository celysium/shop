<?php

namespace App\Modules\Admin\Services\Category;

use App\Modules\Core\Models\Category;
use App\Modules\Core\Repositories\Category\CategoryRepositoryInterface;
use Celysium\Helper\Service\BaseService;
use Illuminate\Support\Collection;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }

    public function children(Category $category): Collection
    {
        return $this->categoryRepository->children($category);
    }

    public function tree(Category $category): Category
    {
        return $this->categoryRepository->tree($category);
    }
}
