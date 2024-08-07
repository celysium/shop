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

        $this->fillAttributes($category, $parameters);

        DB::commit();

        return $category->refresh();
    }

    public function update(Model $model, $parameters): model
    {
        DB::beginTransaction();

        $this->sortPositions($parameters);

        $model->update($parameters);

        $this->fillAttributes($model, $parameters);

        DB::commit();

        return $model->refresh();
    }

    private function fillAttributes(Model $model, array $parameters): void
    {
        /** @var Category $model */
        $category = $model;
        $parent = $category->parent;
        $category->path = array_merge($parent ? $parent->path : [], [$category->only(['id', 'name'])]);
        $category->level = $parent ? $parent->level + 1 : 0;
        $category->slug = slug($category->name);
        if (isset($parameters['icon'])) {
            $category->icon = $category->fileStore($parameters['icon'], 'icon');
        }
        if (isset($parameters['image'])) {
            $category->image = $category->fileStore($parameters['image'], 'image');
        }
        $category->save();
        foreach ($category->children as $child) {
            $this->fillAttributes($child, []);
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

    public function children(Category $category, $columns = ['*']): Collection
    {
        return $this->model->query()
            ->where('parent_id', $category->id)
            ->get($columns);
    }

    public function tree(array $parameters, $conditions = []): Category
    {
        $categories = $this->model->query()
            ->where($conditions)
            ->get(['id', 'name', 'slug', 'parent_id']);

        /** @var Category $category */
        $category = $categories
            ->when(isset($parameters['id']), fn($query) => $query->where('id', $parameters['id']))
            ->when(isset($parameters['slug']), fn($query) => $query->where('slug', $parameters['slug']))
            ->firstOrFail();

        return $this->getChildren($categories, $category);
    }

    public function getChildren(Collection $categories, Category &$category): Category
    {
        $category->children = $children = $categories->where('parent_id', $category->id);

        /** @var Category $child */
        foreach ($children as $child) {
            $child->children = $this->getChildren($categories, $child);
        }

        return $category;
    }

}
