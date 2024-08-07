<?php

namespace App\Modules\Core\Repositories\Banner;

use App\Modules\Core\Models\Banner;
use Celysium\Helper\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BannerRepository extends BaseRepository
{
    protected static string $entity = Banner::class;

    public function conditions(Builder $query): array
    {
        return [
            'slider_id' => '=',
            'title'     => 'like',
        ];
    }

    public function store(array $parameters): Model
    {
        DB::beginTransaction();

        $banner = $this->model->newQuery()->create($parameters);

        $this->fillImage($banner, $parameters);

        DB::commit();

        return $banner->refresh();
    }

    public function update(Model $model, array $parameters): Model
    {
        DB::beginTransaction();

        $model->update($parameters);

        $this->fillImage($model, $parameters);

        DB::commit();

        return $model->refresh();
    }


    private function fillImage(Model $model, array $parameters): void
    {
        /** @var Banner $banner */
        $banner = $model;
        if (isset($parameters['image'])) {
            $banner->image = $banner->fileStore($parameters['image'], 'image');
        }
        $banner->save();
    }
}
