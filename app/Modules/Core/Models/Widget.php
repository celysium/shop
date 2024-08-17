<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Enumerations\Widget\Status;
use App\Modules\Core\Traits\HasFile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $icon
 * @property string $banner
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
    use HasFactory, HasFile;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'banner',
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
    protected function icon(): Attribute
    {
        return Attribute::make(
            fn (string $value) => $this->fileUrl($value),
            fn (string $value) => $this->fileStore($value),
        );
    }
    protected function banner(): Attribute
    {
        return Attribute::make(
            fn (string $value) => $this->fileUrl($value),
            fn (string $value) => $this->fileStore($value),
        );
    }
}
