<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\IndexRequest;
use App\Http\Resources\Order\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {
    }

    /**
     * @OA\Get(
     *     tags={"orders"},
     *     path="/api/orders",
     *     description="get orders",
     *
     *      @OA\Parameter(
     *              name="filters",
     *              in="query",
     *              description="filters",
     *              required=false,
     *
     *              @OA\Schema(
     *                  type="array",
     *
     *                  @OA\Items(
     *                      type="object",
     *
     *                      @OA\Property(property="field", type="string"),
     *                      @OA\Property(property="operator", type="string"),
     *                      @OA\Property(property="value", type="string"),
     *                  )
     *              )
     *          ),
     *
     *          @OA\Parameter(
     *               name="sort",
     *               in="query",
     *               description="filters",
     *               required=false,
     *
     *               @OA\Schema(
     *                   type="object",
     *
     *                   @OA\Property(property="field", type="string"),
     *                   @OA\Property(property="direction", type="string"),
     *               )
     *           ),
     *
     *          @OA\Parameter(
     *              name="paging",
     *              in="query",
     *              description="paging",
     *              required=false,
     *
     *              @OA\Schema(
     *                 type="object",
     *
     *                 @OA\Property(property="page", type="integer"),
     *                 @OA\Property(property="limit", type="integer"),
     *              )
     *          ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *           @OA\JsonContent(
     *               type="object",
     *
     *               @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Order")),
     *               @OA\Property(property="status", type="integer", example=200),
     *           ),
     *      ),
     *
     *     @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="message", type="string", example="The selected filters.0.operator is invalid."),
     *              @OA\Property(property="errors", type="object", example="{filters.0.operator: [The selected filters.0.operator is invalid.]}"),
     *          ),
     *      )
     * )
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $orders = $this->orderService->getOrders($validated);

        return $this->successResponse(OrderResource::collection($orders));
    }
}
