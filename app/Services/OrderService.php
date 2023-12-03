<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    public function __construct(private readonly OrderRepository $orderRepository)
    {
    }

    public function getOrders(array $search): Collection|LengthAwarePaginator
    {
        return $this->orderRepository->get(
            query: $search['filters'] ?? [],
            relations: ['user', 'products'],
            options: [
                'paging' => $search['paging'] ?? [],
                'sort' => $search['sort'] ?? [],
            ],
        );

    }
}
