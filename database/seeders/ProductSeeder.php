<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = ['price_1NJhk1BmxT5gIh6pt1UwfQqp', 'price_1K59RIBmxT5gIh6p9bYtrAdY' ];

        $products = [
            [
                'name' => 'Essential',
                'stripe_id' => $options[0],
                'type' => 'subscription',
                'price' => 10.00,
            ],
            [
                'name' => 'Premium',
                'stripe_id' => $options[1],
                'type' => 'subscription',
                'price' => 100.00,
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
