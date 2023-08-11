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
        $options = ['price_1NZI5HBmxT5gIh6ph91MRYo8', 'price_1NJhk1BmxT5gIh6pt1UwfQqp' ];

        $products = [
            [
                'title' => 'Essential',
                'stripe_id' => $options[0],
                'type' => 'subscription',
                'price' => 9.00,
            ],
            [
                'title' => 'Premium',
                'stripe_id' => $options[1],
                'type' => 'subscription',
                'price' => 15.00,
            ],
            [
                'title' => 'Single Product',
                'type' => 'single',
                'stripe_id' => 'price_1NYUrmBmxT5gIh6pYtuvveae',
                'price' => 17.00,
                'asset' => 'https://picsum.photos/200/300',
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
