<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProfileProductsController extends Controller
{
    public function edit(Request $request): Response
    {
        $orders = $request->user()->orders()->get();


        $products = $orders->map(function ($order) {
            return $order->products()->get();
        });

        $products = $products->flatten();

        $products = $products->map(function ($product) {
            return $product->only(['id', 'title', 'price', 'asset']);
        });

        return Inertia::render('Profile/EditProducts', [
            'products' => $products
        ]);
    }
}
