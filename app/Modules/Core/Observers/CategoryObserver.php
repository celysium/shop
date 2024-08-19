<?php

namespace App\Modules\Core\Observers;

use App\Modules\Core\Models\Category;
use App\Modules\Core\Repositories\Category\CategoryRepository;

class CategoryObserver
{
    /**
     * Handle the Cart "created" event.
     */
    public function created(Category $category): void
    {
        CategoryRepository::fillPath($category);
    }

    /**
     * Handle the Cart "updated" event.
     */
    public function updated(Category $category): void
    {
        CategoryRepository::fillPath($category);
    }
}
