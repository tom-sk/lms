<?php

namespace App\Services;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripeService
{
    public function create(Product $product, string $successUrl, string $cancelUrl){
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $product->title,
                ],
                'unit_amount' => $product->price * 100,
            ],
            'quantity' => 1,
        ];

        return \Stripe\Checkout\Session::create([
            'line_items' => [[
                $lineItems
            ]],
            'mode' => 'payment',
            'success_url' => $successUrl . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => $cancelUrl,
            'allow_promotion_codes' => true,
        ]);
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }
            $customer = \Stripe\Customer::retrieve($session->customer);

            $order = Order::where('session_id', $session->id)->first();
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }

            return view('product.checkout-success', compact('customer'));
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

    }
}
