<?php

namespace App\Models;

use App\Enumerations\Delivery\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property int $driver
 * @property Status $status
 * @property array $config
 */
class Delivery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'driver',
        'status',
        'config',
    ];

    protected $casts = [
        'config' => 'array',
        'status' => Status::class,
    ];
}
