<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Casts\File;
use App\Modules\Core\Traits\HasEnumeration;
use App\Modules\Core\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $slider_id
 * @property string $image
 * @property string $title
 * @property string $url
 * @property int $position
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Banner extends Model
{
    use HasFactory, HasFile, HasEnumeration;

    protected $fillable = [
        'slider_id',
        'image',
        'title',
        'url',
        'position',
        'status',
    ];

    protected $casts = [
        'image' => File::class,
    ];

    /**
     * @return BelongsTo
     */
    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }
}
