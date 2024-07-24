<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property  int $id
 * @property int $user_id
 * @property int $province_id
 * @property int $city_id
 * @property mixed $latitude
 * @property mixed $longitude
 * @property string $detail
 * @property string $postcode
 * @property string $plate
 * @property string $floor
 * @property string $unit
 * @property boolean $is_default
 *
 * @property User $user
 * @property Location $city
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'province_id',
        'city_id',
        'latitude',
        'longitude',
        'detail',
        'postcode',
        'plate',
        'unit',
        'is_default',
    ];
    protected $casts = [
        'is_default' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    protected static function newFactory(): AddressFactory
    {
        return AddressFactory::new();
    }
}
