<?php

namespace App\Modules\Core\Models;

use App\Modules\Core\Traits\HasEnumeration;
use Carbon\Carbon;
use Celysium\Permission\Traits\Permissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $password
 * @property string $avatar
 * @property int $gender
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, Permissions, HasApiTokens, HasEnumeration;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mobile',
        'email',
        'firstname',
        'lastname',
        'password',
        'avatar',
        'gender',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
