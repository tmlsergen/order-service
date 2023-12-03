<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

//$table->id();
//$table->string('name');
//$table->decimal('unit_price', 10, 2);
//$table->text('description');
//$table->string('image');
//$table->boolean('active')->default(true);
//$table->timestamps();

/**
 * @OA\Schema(
 *     title="Product",
 *     description="Product model",
 *
 *     @OA\Xml(name="Product"),
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
 *     example="Product 1"
 *     ),
 *     @OA\Property(
 *     property="unit_price",
 *     title="unit_price",
 *     description="unit_price",
 *     type="decimal",
 *     example="1.00"
 *     ),
 *     @OA\Property(
 *     property="description",
 *     title="description",
 *     description="description",
 *     type="string",
 *     example="Product 1 description"
 *     ),
 *     @OA\Property(
 *     property="image",
 *     title="image",
 *     description="image",
 *     type="string",
 *     example="https://via.placeholder.com/150"
 *     ),
 *     @OA\Property(
 *     property="active",
 *     title="active",
 *     description="active",
 *     type="boolean",
 *     example="true"
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
 *    )
 * )
 */
class Product extends Model
{
    use HasFactory, Searchable;

    protected $guarded = ['id'];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
