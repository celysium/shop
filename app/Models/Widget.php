<?php

namespace App\Models;

use App\Enumerations\Widget\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $url
 * @property Status $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property Collection<ProductWidget> $items
 *
 */
class Widget extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'url',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(ProductWidget::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_widget', 'widget_id','id')->withTimestamps();
    }
}
