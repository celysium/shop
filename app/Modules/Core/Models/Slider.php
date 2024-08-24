<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $status
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

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class);
    }
}
