<?php

namespace App\Modules\Core\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property string $username
 * @property string $code
 * @property int $tries
 * @property Carbon $sent_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TemporaryPassword extends Model
{

    use HasFactory;

    protected $fillable = [
        'username',
        'code',
        'tries',
        'sent_at',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime'
        ];
    }
}
