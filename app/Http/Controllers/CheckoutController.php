<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
    public function __invoke(Request $request){
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $request->validate([
            'id' => 'required|int|max:255|exists:products,id',
        ]);

        $product = Product::find($request->id);

//        $lineItems = [];
        $lineItems[] = [
            'price' => 'price_1NYUrmBmxT5gIh6pYtuvveae',
            'quantity' => 1,
        ];

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
            'allow_promotion_codes' => true,
        ]);

        $order = new Order();
        $order->status = 'unpaid';
        $order->total_price = $product->price;
        $order->session_id = $session->id;
        $order->product_id = $product->id;
        $order->save();

        return response()->json(['url' => $session->url]);
    }


    public function cancel(){
        return redirect()->back();
    }

    public function success(Request $request){
//        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');
//        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $session = $stripe->checkout->sessions->retrieve(
            $sessionId,
            []
        );

        try {
            if (!$session) {
                throw new NotFoundHttpException;
            }
            $stripeCustomer = $stripe->customers->retrieve(
                $session->customer,
                []
            );

            $customer = User::where('email', $stripeCustomer->email)->first();

            if (!$customer) {
                $customer = Customer::firstOrCreate([
                    'email' => $stripeCustomer->email,
                ]);
            }

            $order = Order::where('session_id', $session->id)->first();

            $customer->orders()->save($order);

            if (!$order) {
                throw new NotFoundHttpException();
            }

            return Inertia::render('Product/Success',  compact('customer'));
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }
    }

    public function webhook()
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

// Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('session_id', $session->id)->first();
                if ($order && $order->status === 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                    // Send email to customer
                }

            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}
