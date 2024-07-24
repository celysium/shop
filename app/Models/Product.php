<?php

namespace App\Models;

use App\Enumerations\Product\Status;
use App\Enumerations\Product\Type;
use App\Enumerations\Product\Visibility;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $sku
 * @property string $slug
 * @property string $description
 * @property Type $type
 * @property Status $status
 * @property Visibility $visibility
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property Product $parent
 * @property Collection<Category> $categories
 * @property Collection<ProductImage> $images
 */
class Product extends Model
{
    use  HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'sku',
        'slug',
        'description',
        'parent_id',
        'type',
        'status',
        'visibility',
    ];

    protected $casts = [
        'type'       => Type::class,
        'status'     => Status::class,
        'visibility' => Visibility::class,
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id')
            ->orderBy('position');
    }
}
