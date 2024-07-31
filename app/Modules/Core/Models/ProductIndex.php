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
 * @property int $product_id
 * @property string $name
 * @property string $sku
 * @property string $slug
 * @property string $description
 * @property Type $type
 * @property Status $status
 * @property Visibility $visibility
 * @property int $store_id
 * @property bool $is_stock
 * @property int $quantity
 * @property int $buy_price
 * @property int $original_price
 * @property int $promoted_activated_at
 * @property int $promoted_expired_at
 * @property int $promoted_price
 * @property array $categories
 * @property array $images
 * @property array $stores
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ProductIndex extends Model
{
    use  HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'slug',
        'description',
        'parent_id',
        'type',
        'status',
        'visibility',
        'product_id',
        'store_id',
        'is_stock',
        'quantity',
        'buy_price',
        'original_price',
        'promoted_price',
        'promoted_activated_at',
        'promoted_expired_at',
        'categories',
        'images',
        'stores',
    ];

    protected $casts = [
        'type'       => Type::class,
        'status'     => Status::class,
        'visibility' => Visibility::class,
    ];
}
