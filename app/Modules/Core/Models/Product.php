<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Enumerations\Product\Status;
use App\Modules\Core\Enumerations\Product\Type;
use App\Modules\Core\Enumerations\Product\Visibility;
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
 * @property Collection<Category> $categories
 * @property Collection<Inventory> $inventories
 * @property Collection<ProductImage> $images
 * @property Collection<Store> $stores
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

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'inventories');
    }
}
