<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int $store_id
 * @property bool $is_stock
 * @property int $quantity
 * @property int $buy_price
 * @property int $original_price
 * @property int $promoted_activated_at
 * @property int $promoted_expired_at
 * @property int $promoted_price
 * @property array $images
 * @property array $categories
 * @property Product $product
 */
class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'store_id',
        'is_stock',
        'quantity',
        'buy_price',
        'original_price',
        'promoted_price',
        'promoted_activated_at',
        'promoted_expired_at',
        'cache',
    ];

    protected $casts = [
        'cache'      => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
