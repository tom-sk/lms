<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\SingleProductRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{

    public function __construct(private StripeService $stripeService, private OrderService $orderService)
    {
    }

    public function __invoke(SingleProductRequest $request)
    {

        $data = $request->toDto();

        $product = Product::find($data->id);

        $session = $this->stripeService->create($product, route('onboard.questions.step-one'), route('onboard.payment'));

//        $this->orderService->create($data->price, $session);

        return response()->json([
            'url' => $session->url
        ], Response::HTTP_OK);
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

    public function single(Product $product)
    {
//        $stripe = new \Stripe\StripeClient('sk_test_51K59QtBmxT5gIh6pPxNRMR9knRTXeaP9v3DcJ9PblkAFn4thlrAHibSawl2dVXsY4E9BUZag3wM8SQh54S2l465t0081KQcBSW');
//        $intent = $stripe->paymentIntents->create([
//            'amount' => $product->price * 100,
//            'currency' => 'gbp',
//            'automatic_payment_methods' => [
//                'enabled' => true,
//            ],
//        ]);

        return Inertia::render('ProductPage', [
//            'secret' => $intent->client_secret,
            'product' => $product
        ]);
    }
}
