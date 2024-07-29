<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Enumerations\Banner\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $slider_id
 * @property string $path
 * @property string $title
 * @property string $url
 * @property int $position
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'slider_id',
        'path',
        'title',
        'url',
        'position',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    /**
     * @return BelongsTo
     */
    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }
}
