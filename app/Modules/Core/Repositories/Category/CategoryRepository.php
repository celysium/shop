<?php

namespace App\Modules\Core\Repositories\Category;

use App\Modules\Core\Models\Category;
use Celysium\Helper\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
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
}
