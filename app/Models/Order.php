<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

/**
 * @OA\Schema(
 * title="Orders",
 * description="Orders model",
 *
 * @OA\Xml(name="Order"),
 *
 * @OA\Property(
 *     property="id",
 *     title="id",
 *     description="id",
 *     type="integer",
 *     example="1"
 * ),
 * @OA\Property(
 *     property="order_number",
 *     title="order_number",
 *     description="order_number",
 *     type="string",
 *     example="1"
 * ),
 * @OA\Property(
 *     property="user_id",
 *     title="user_id",
 *     description="user_id",
 *     type="integer",
 *     example="1"
 * ),
 * @OA\Property(
 *     property="status",
 *     title="status",
 *     description="status",
 *     type="string",
 *     example="pending"
 * ),
 * @OA\Property(
 *     property="total",
 *     title="total",
 *     description="total",
 *     type="integer",
 *     example="1"
 * ),
 * @OA\Property(
 *     property="tax",
 *     title="tax",
 *     description="tax",
 *     type="integer",
 *     example="1"
 * ),
 * @OA\Property(
 *     property="shipping",
 *     title="shipping",
 *     description="shipping",
 *     type="integer",
 *     example="1"
 * ),
 * @OA\Property(
 *     property="shipping_address",
 *     title="shipping_address",
 *     description="shipping_address",
 *     type="string",
 *     example="1"
 * ),
 * @OA\Property(
 *     property="billing_address",
 *     title="billing_address",
 *     description="billing_address",
 *     type="string",
 *     example="1"
 * ),
 * @OA\Property(
 *     property="payment_method",
 *     title="payment_method",
 *     description="payment_method",
 *     type="string",
 *     example="card"
 * ),
 * @OA\Property(
 *     property="order_date",
 *     title="order_date",
 *     description="order_date",
 *     type="string",
 *     example="2021-09-01 00:00:00"
 * ),
 * @OA\Property(
 *     property="created_at",
 *     title="created_at",
 *     description="created_at",
 *     type="string",
 *     example="2021-09-01 00:00:00"
 * ),
 * @OA\Property(
 *     property="updated_at",
 *     title="updated_at",
 *     description="updated_at",
 *     type="string",
 *     example="2021-09-01 00:00:00"
 * ),
 * @OA\Property(
 *     property="user",
 *     title="user",
 *     description="user",
 *     type="object",
 *     ref="#/components/schemas/User"
 * ),
 * @OA\Property(
 *     property="products",
 *     title="products",
 *     description="products",
 *     type="array",
 *
 *     @OA\Items(
 *     type="object",
 *     ref="#/components/schemas/Product"
 *     )
 * )
 *)
 */
class Order extends Model
{
    use HasFactory, Searchable;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
