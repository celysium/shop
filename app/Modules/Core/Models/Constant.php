<?php

namespace App\Modules\Core\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $key
 * @property bool|int|string|array $value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Constant extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'key',
        'value',
    ];

    public function value(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => is_array($value) ? json_encode($value) : $value,
            set: fn (mixed $value) => json_decode($value, true) ?: $value
        );
    }
}
