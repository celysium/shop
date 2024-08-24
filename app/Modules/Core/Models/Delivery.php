<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Traits\HasEnumeration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property int $driver
 * @property int $status
 * @property array $config
 */
class Delivery extends Model
{
    use HasFactory, SoftDeletes, HasEnumeration;

    protected $fillable = [
        'name',
        'driver',
        'status',
        'config',
    ];

    protected $casts = [
        'config' => 'array',
    ];
}
