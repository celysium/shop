<?php

namespace App\Modules\Core\Repositories\Category;

use App\Modules\Core\Models\Category;
use Celysium\Helper\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected static string $entity = Category::class;

    public function store(array $parameters): Model
    {
        DB::beginTransaction();

        $this->sortPositions($parameters);

        /** @var Category $category */
        $category = $this->model->newQuery()->create($parameters);

        DB::commit();

        return $category->refresh();
    }

    public function update(Model $model, $parameters): model
    {
        DB::beginTransaction();

        $this->sortPositions($parameters);

        $model->update($parameters);

        DB::commit();

        return $model->refresh();
    }

    public static function fillPath(Category $category): void
    {
        $parent = $category->parent;
        $category->path = array_merge($parent ? $parent->path : [], [$category->only(['id', 'name', 'slug'])]);
        $category->save();
        foreach ($category->children as $child) {
            static::fillPath($child);
        }
    }

    private function sortPositions(array &$parameters): void
    {
        if (array_key_exists('position', $parameters)) {
            Category::query()
                ->where('parent_id', $parameters['parent_id'])
                ->where('position', '>=', $parameters['position'])
                ->increment('position');
        } else {
            $parameters['position'] = Category::query()
                    ->where('parent_id', $parameters['parent_id'])
                    ->max('position') + 1;
        }
    }

    public function children(Category $category): Collection
    {
        return $this->model->query()
            ->with('children')
            ->where('parent_id', $category->id)
            ->get(['id', 'name', 'slug', 'parent_id']);
    }

    public function tree(Category $category, array $conditions = []): Category
    {
        $categories = $this->model->query()
            ->where($conditions)
            ->get(['id', 'name', 'slug', 'parent_id']);

        return $this->getChildren($categories, $category);
    }

    public function getChildren(Collection $categories, Category $category): Category
    {
        $category->children = $children = $categories->where('parent_id', $category->id);

        /** @var Category $child */
        foreach ($children as $child) {
            $child->children = $this->getChildren($categories, $child);
        }

        return $category;
    }

}
