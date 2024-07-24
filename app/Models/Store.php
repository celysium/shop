<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'image',
    ];
}
