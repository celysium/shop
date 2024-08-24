<?php

namespace App\Modules\Core\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property string $sku
 * @property string $slug
 * @property string $description
 * @property int $type
 * @property int $status
 * @property int $visibility
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
}
