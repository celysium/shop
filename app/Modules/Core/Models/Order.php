<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Enumerations\Order\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Collection\Collection;

/**
 * @property int $id
 * @property int customer_id
 * @property int address_id
 * @property int delivery_id
 * @property int status
 * @property array details
 * @property int total_buy_price
 * @property int total_promotion_price
 * @property int total_discount_price
 * @property int total_price
 * @property int total_refunded_price
 * @property int total_profit_price
 *
 * @property Collection<OrderItem> $items
 * @property User $customer
 * @property Address $address
 * @property Delivery $delivery
 *
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'address_id',
        'delivery_id',
        'status',
        'total_buy_price',
        'total_promotion_price',
        'total_discount_price',
        'total_price',
        'total_profit_price',
        'details',
    ];

    protected $casts = [
        'status'  => Status::class,
        'details' => 'array',
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

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

}
