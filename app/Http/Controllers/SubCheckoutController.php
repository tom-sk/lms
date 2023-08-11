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
            ->newSubscription('default', $product->stripe_id)
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('onboard.questions.step-one'),
                'cancel_url' => route('sub-checkout.cancel', [], true),
            ]);
        /** @phpstan-ignore-next-line */
        return response()->json(['url' => $session->url]);
    }

    public function cancel(){
        return redirect()->back();
    }
}
