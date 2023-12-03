<?php

namespace Tests\Feature;

use App\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_orders_index_returns_a_successful_response(): void
    {
        $response = $this->get('/api/orders');

        $response->assertStatus(200);
    }

    public function test_orders_index_has_valid_structure(): void
    {
        $responseStructure = [
            'data' => [
                '*' => [
                    'id',
                    'order_number',
                    'status',
                    'total_price',
                    'tax',
                    'shipping',
                    'shipping_address',
                    'billing_address',
                    'payment_method',
                    'order_date',
                    'user' => [
                        'id',
                        'name',
                    ],
                    'products' => [
                        '*' => [
                            'id',
                            'name',
                            'quantity',
                            'unit_price',
                            'total_price',
                        ],
                    ],
                ],
            ],
            'status',
        ];

        $response = $this->get('/api/orders');

        $response->assertOk()->assertJsonStructure($responseStructure);
    }

    public function test_orders_filter_returns_a_valid_response(): void
    {
        $order = Order::factory(1)->create()->each(function ($order) {
            $order->products()->attach(1, ['quantity' => 1]);
        });

        $query = [
            'filters' => [
                [
                    'field' => 'order_number',
                    'operator' => '=',
                    'value' => $order[0]->order_number,
                ],
            ],
        ];

        $queryString = http_build_query($query);

        $response = $this->get('/api/orders?'.$queryString);

        $response->assertOk()
            ->assertJsonFragment(['order_number' => $order[0]->order_number])
            ->assertJsonCount(1, 'data');
    }

    public function test_orders_filter_returns_validation_error(): void
    {
        $query = [
            'filters' => [
                [
                    'field' => 'order_number',
                    'operator' => '==',
                    'value' => 'test',
                ],
            ],
        ];

        $queryString = http_build_query($query);

        $expectedJson = [
            'message' => 'The selected filters.0.operator is invalid.',
            'errors' => [
                'filters.0.operator' => [
                    'The selected filters.0.operator is invalid.',
                ],
            ],
        ];

        $response = $this->get('/api/orders?'.$queryString, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $response->assertUnprocessable()
            ->assertJson($expectedJson);
    }
}
