<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SingleProductController extends Controller
{
    public function __invoke(Product $product)
    {
        $intent = auth()->user()->createSetupIntent();

        return Inertia::render('ProductPage',  compact('product', 'intent'));
    }

    public function store(Request $request){

        $user          = auth()->user();
        $paymentMethod = $request['paymentMethod'];

//        dd($request['productId']);

        $product = Product::find($request['productId']);

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($product->price * 100, $paymentMethod);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return Inertia::render('Product/Success');
    }

    public function success(Request $request)
    {
        return Inertia::render('Product/Success');

    }
}
