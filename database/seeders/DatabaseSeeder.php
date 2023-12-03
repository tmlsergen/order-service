<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        $products = \App\Models\Product::factory(10)->create();

        \App\Models\Order::factory(5)->create()->each(function ($order) use ($products) {
            $attachments = $products->random(2)->pluck('id');
            $order->products()->attach($attachments, ['quantity' => rand(1, 5)]);
        });
    }
}
