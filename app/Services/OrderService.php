<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function create(string $totalPrice, object $session){
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->status = 'unpaid';
        $order->total_price = $totalPrice;
        $order->session_id = $session->id;
        $order->save();
    }
}
