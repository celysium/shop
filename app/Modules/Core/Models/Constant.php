<?php

namespace App\Modules\Core\Models;

use Carbon\Carbon;
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

    protected $casts = [
        'value' => 'json'
    ];
}
