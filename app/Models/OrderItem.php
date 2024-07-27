<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int order_id
 * @property int product_id
 * @property int store_id
 * @property int quantity
 * @property int buy_price
 * @property int original_price
 * @property int promoted_price
 * @property int total_price
 * @property int total_refunded_price
 * @property int total_profit_price
 * @property array $details
 *
 * @property Order $order
 * @property Product $product
 * @property Inventory $inventory
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'store_id',
        'quantity',
        'buy_price',
        'original_price',
        'promoted_price',
        'total_price',
        'total_profit_price',
        'details'
    ];

    protected $casts = [
        'details' => 'array'
    ];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

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
