<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Enumerations\Slider\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property Status $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<Banner> $banners
 */
class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class);
    }
}
