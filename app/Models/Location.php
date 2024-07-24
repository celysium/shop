<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property Location $parent_id
 * @property string $name
 * @property string $full_name
 * @property Location $parent
 * @property Collection<Location> $children
 */
class Location extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'parent_id',
        'name',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    public function getFullNameAttribute(): string
    {
        return $this->parent_id ? "{$this->name} {$this->parent->name}" : $this->name;
    }
}
