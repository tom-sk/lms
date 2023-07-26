<?php

namespace App\Http\Controllers;

use App\Http\Requests\SingleProductRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

//        TODO: Assign order to customer
        $order = Order::create([
            'user_id' => $customer->id,
            'product_id' => $data->productId,
            'status' => 'unpaid',
        ]);


        $paymentMethod = $data->paymentMethod;

        $product = Product::find($data->productId);

        try {
            $customer->createOrGetStripeCustomer();
            $customer->updateDefaultPaymentMethod($paymentMethod);
            $customer->charge($product->price * 100, $paymentMethod);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

        $order->update([
            'status' => 'paid',
        ]);

        return Inertia::render('Product/Success');
    }

    public function success(Request $request)
    {

        //        TODO: send product in email or allow acces some other way

        return Inertia::render('Product/Success');

    }
}
