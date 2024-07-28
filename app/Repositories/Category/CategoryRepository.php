<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Celysium\Helper\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function store(array $parameters): Model
    {
        $this->sortPositions($parameters);

        /** @var Category $category */
        $category = $this->model->newQuery()->create($parameters);

        $this->fillAttributes($category, $parameters);

        return $category->refresh();
    }

    public function update(Model $model, $parameters): model
    {
        $this->sortPositions($parameters);

        $model->update($parameters);

        $this->fillAttributes($model, $parameters);

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
        $category->icon = isset($parameters['icon']) ? storageStore($parameters['icon']) : $category->icon;
        $category->image = isset($parameters['image']) ? storageStore($parameters['image']) : $category->image;
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
