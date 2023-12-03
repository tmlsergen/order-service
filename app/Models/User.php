<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *
 *     @OA\Xml(name="User"),
 *
 *     @OA\Property(
 *     property="id",
 *     title="id",
 *     description="id",
 *     type="integer",
 *     example="1"
 *     ),
 *     @OA\Property(
 *     property="name",
 *     title="name",
 *     description="name",
 *     type="string",
 *     example="John Doe"
 *     ),
 *     @OA\Property(
 *     property="email",
 *     title="email",
 *     description="email",
 *     type="string",
 *     example="test@test.com"
 *     ),
 *     @OA\Property(
 *     property="role",
 *     title="role",
 *     description="role",
 *     type="string",
 *     example="customer"
 *     ),
 *     @OA\Property(
 *     property="created_at",
 *     title="created_at",
 *     description="created_at",
 *     type="string",
 *     example="2021-01-01 00:00:00"
 *     ),
 *     @OA\Property(
 *     property="updated_at",
 *     title="updated_at",
 *     description="updated_at",
 *     type="string",
 *     example="2021-01-01 00:00:00"
 *     )
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
