<?php

namespace App\Modules\Core\Models;

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
 * @property array $details
 * @property int $total_promoted_price
 * @property int $total_discount_price
 * @property int $total_price
 *k
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
        'total_promoted_price',
        'total_discount_price',
        'total_price',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
        'items' => 'array',
    ];

    public array $detailFields = [
        'customer.mobile',
        'customer.firstname',
        'customer.lastname',
        'address.latitude',
        'address.longitude',
        'address.detail',
        'address.postcode',
        'address.plate',
        'address.floor',
        'address.unit',
        'address.province.id',
        'address.province.name',
        'address.city.id',
        'address.city.name',
        'delivery.name',
        'delivery.driver',
        'delivery.price',
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
