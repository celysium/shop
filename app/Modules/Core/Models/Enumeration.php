<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property  int $id
 * @property string $model
 * @property string $field
 * @property string $case
 * @property mixed $cast
 */
class Enumeration extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'model',
        'field',
        'case',
        'cast',
    ];

    protected function cast(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => $value === null ? $value : serialize($value),
            set: fn(mixed $value) => $value === null ? $value : unserialize($value),
        );
    }
}
