<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Enumerations\Banner\Status;
use App\Modules\Core\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property int $slider_id
 * @property string $image
 * @property string $image_url
 * @property string $title
 * @property string $url
 * @property int $position
 * @property Status $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Banner extends Model
{
    use HasFactory, HasFile;

    protected $fillable = [
        'slider_id',
        'image',
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

    public function getImageUrlAttribute(): string
    {
        return Storage::url($this->image);
    }
}
