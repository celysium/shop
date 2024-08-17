<?php

namespace App\Modules\Core\Repositories\Widget;

use App\Modules\Core\Models\Widget;
use Celysium\Helper\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WidgetRepository extends BaseRepository
{
    protected static string $entity = Widget::class;

    public function store(array $parameters): Model
    {
        DB::beginTransaction();

        /** @var Widget $widget */
        $widget = $this->model->newQuery()->create($parameters);

        $widget->products()->attach($parameters['products_id']);

        DB::commit();

        return $widget->refresh();
    }

    public function update(Model $model, array $parameters): Model
    {
        DB::beginTransaction();

        /** @var Widget $widget */
        $model->update($parameters);

        $widget->products()->sync($parameters['products_id']);

        DB::commit();

        return $widget->refresh();
    }
}
