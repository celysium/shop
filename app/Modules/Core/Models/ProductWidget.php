<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $widget_id
 * @property int $product_id
 *
 * @property Widget $widget
 * @property Product $product
 */
class ProductWidget extends Model
{
    use HasFactory;

    protected $fillable = [
        'widget_id',
        'product_id',
    ];

    /**
     * @return BelongsTo
     */
    public function widget(): BelongsTo
    {
        return $this->belongsTo(Widget::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
