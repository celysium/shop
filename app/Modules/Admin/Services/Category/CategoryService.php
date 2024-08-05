<?php

namespace App\Modules\Admin\Services\Category;

use App\Modules\Core\Repositories\Category\CategoryRepositoryInterface;
use Celysium\Helper\Service\BaseService;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }
}
