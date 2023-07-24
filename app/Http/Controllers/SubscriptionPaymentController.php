<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;


class SubscriptionPaymentController extends Controller
{
    public function subscribe(Request $request): Response
    {
        return Inertia::render('Subscribe',
            [
                'intent' => auth()->user()->createSetupIntent(),
            ]
        );
    }

    public function pay(PaymentRequest $request): Response
    {

        $validated = $request->validated();

//        $coupon = Coupon::where('name',$validated['coupon'])->first();

//        if($coupon){
//            auth()->user()->newSubscription('cashier', $validated['productId'])
//                ->withCoupon($coupon['stripe_id'])
//                ->create($validated['paymentMethod']);
//        } else {
            auth()->user()->newSubscription('cashier', $validated['productId'])
                ->create($validated['paymentMethod']);
//        }

//        return redirect()->back()->with(['flash.success' => 'Subscripbtion Created!!']);

        return Inertia::render('Dashboard')->with(['flash.success' => 'Subscripbtion Created!!']);
    }

    public function payOnboard(PaymentRequest $request): Response
    {

        $validated = $request->validated();


        auth()->user()->newSubscription('cashier', $validated['productId'])
            ->create($validated['paymentMethod']);

        return Inertia::render('Onboard/Questions')->with(['flash.success' => 'Subscripbtion Created!!']);
    }
}
