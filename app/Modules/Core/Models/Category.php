<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Casts\File;
use App\Modules\Core\Traits\HasEnumeration;
use App\Modules\Core\Traits\HasFile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property Category $parent
 * @property int $parent_id
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $banner
 * @property string $slug
 * @property string $description
 * @property int $status
 * @property int $visible
 * @property array $path
 * @property integer $position
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property Collection $products
 * @property Collection $children
 */
class Category extends Model
{
    use HasFactory, SoftDeletes, HasFile, HasEnumeration;

    public const ROOT = 1;

    protected $casts = [
        'path'   => 'array',
        'icon'   => File::class,
        'banner' => File::class,
    ];

    protected $fillable = [
        'id',
        'name',
        'parent_id',
        'slug',
        'icon',
        'path',
        'banner',
        'description',
        'status',
        'position',
        'visible',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
