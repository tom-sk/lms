<?php

namespace App\Http\Controllers;

use App\Http\Requests\SingleProductRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SingleProductController extends Controller
{
    public function __invoke(Product $product)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $intent = $stripe->setupIntents->create(['usage' => 'on_session']);;

        return Inertia::render('ProductPage',  compact('product', 'intent'));
    }

    public function store(SingleProductRequest $request){

        $data = $request->toDto();

        if (Auth::check()) {
            $customer = auth()->user();
        } else {
            $customer = User::where('email', $data->email)->first();

            if (!$customer) {
                $customer = Customer::firstOrCreate([
                    'email' => $data->email,
                ]);
            }
        }
//
        $customer->orders()->create([
            'product_id' => $data->productId,
            'status' => 'pending',
        ]);

        $paymentMethod = $data->paymentMethod;

        $product = Product::find($data->productId);

        auth()->user()->charge(
            100, $data->paymentMethod
        );

        try {
//            $customer->createOrGetStripeCustomer();
//            $customer->updateDefaultPaymentMethod($paymentMethod);
//            $customer->charge($product->price * 100, $paymentMethod);
        } catch (\Exception $exception) {
//            dd($exception->getMessage());
        }


//        return to_route('product.checkout-success');
        return Inertia::render('Product/Success' ,['checkoutSession' => '{CHECKOUT_SESSION_ID}']);
    }

    public function success(Request $request)
    {

        //        TODO: send product in email or allow access some other way

//        dd($request->user());
//        $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));

        return Inertia::render('Product/Success' ,['checkoutSession' => '$checkoutSession']);

    }

    public function webhook(Request $request)
    {
//         TODO: listen to webhook and complete order status
    }

    public function test(Product $product)
    {
        return Inertia::render('Product/Show',  compact('product'));

    }
}
