<?php

namespace App\Modules\Core\Repositories\Banner;

use App\Modules\Core\Models\Banner;
use Celysium\Helper\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    protected static string $entity = Banner::class;

    public function conditions(Builder $query): array
    {
        return [
            'slider_id' => '=',
            'title'     => 'like',
        ];
    }

    /**
     * @param array $parameters
     * @return Model
     */
    public function store(array $parameters): Model
    {
        DB::beginTransaction();

        /** @var Banner $model */
        $this->rearrangePosition($parameters);

        /** @var Banner $banner */
        $banner = $this->model->query()->create($parameters);

        DB::commit();

        return $banner;
    }

    public function update(Model $model, array $parameters): Model
    {
        DB::beginTransaction();

        /** @var Banner $model */
        $this->rearrangePosition($parameters, $model->position);

        /** @var Banner $banner */
        $model->update($parameters);

        DB::commit();

        return $model->refresh();
    }

    /**
     * @param array $parameters
     * @param int|null $currentPosition
     * @return void
     */
    public static function rearrangePosition(array &$parameters, int $currentPosition = null): void
    {
        $newPosition = $parameters['position'] ?? null;

        if (!array_key_exists('slider_id', $parameters)) {
            return;
        }

        if ($newPosition == null || $currentPosition == null) {
            $parameters['position'] = Banner::query()
                    ->where('slider_id', $parameters['slider_id'])
                    ->max('position') + 1;
            return;
        }

        if ($currentPosition == $newPosition) {
            return;
        }

        if ($newPosition > $currentPosition) {
            Banner::query()
                ->where('slider_id', $parameters['slider_id'])
                ->where('position', '>=', $currentPosition)
                ->where('position', '<', $newPosition)
                ->decrement('position');
        } else {
            Banner::query()
                ->where('slider_id', $parameters['slider_id'])
                ->where('position', '<', $currentPosition)
                ->where('position', '>=', $newPosition)
                ->increment('position');
        }
    }
}
