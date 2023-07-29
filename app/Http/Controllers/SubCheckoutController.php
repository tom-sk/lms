<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class SubCheckoutController extends Controller
{
    public function __invoke(SubscriptionRequest $request){

        $data = $request->toDto();
       $product = Product::find($data->id);

        $session = auth()->user()
            ->newSubscription($product->title, $product->stripe_id)
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('onboard.questions.step-one'),
                'cancel_url' => route('sub-checkout.cancel', [], true),
            ]);

        return response()->json(['url' => $session->url]);
    }

    public function cancel(){
        return redirect()->back();
    }

    public function test(Request $request){
        return $request->user()
            ->newSubscription('essential', 'price_1NZI5HBmxT5gIh6ph91MRYo8')
            ->checkout([
                'success_url' => route('onboard.questions.step-one'),
                'cancel_url' => route('sub-checkout.cancel', [], true),
            ]);
    }
}
