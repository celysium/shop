<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Traits\HasEnumeration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $customer_id
 * @property int $order_id
 * @property int $status
 * @property string $transaction_id
 * @property string $reference_id
 * @property int $amount
 * @property array $request
 * @property array $response
 * @property string $description
 *
 * @property User $customer
 * @property Order $order
 */
class Payment extends Model
{
    use HasFactory, HasEnumeration;

    protected $fillable = [
        'customer_id',
        'order_id',
        'status',
        'transaction_id',
        'reference_id',
        'amount',
        'details',
        'response',
    ];

    protected $casts = [
        'details'  => 'array',
        'response' => 'array',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);

    }
}
