<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $code
 * @property int $customer_id
 * @property int $address_id
 * @property int $delivery_id
 * @property array $items
 * @property array $cache
 * @property int $total_promotion_price
 * @property int $total_discount_price
 * @property int $total_price
 *
 *
 * @property User $customer
 * @property Address $address
 * @property Delivery $delivery
 *
 */
class Cart extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'id',
        'customer_id',
        'address_id',
        'delivery_id',
        'items',
        'total_promotion_price',
        'total_discount_price',
        'total_price',
        'cache',
    ];

    protected $casts = [
        'cache' => 'array',
        'items' => 'array',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }
}
