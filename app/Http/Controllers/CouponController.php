<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use Symfony\Component\HttpFoundation\Response;


class CouponController extends Controller
{
    public function __invoke(CouponRequest $request)
    {
        $validated = $request->safe()->only(['userCoupon']);


        $userCoupon = $validated['userCoupon'];

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $coupons = $stripe->coupons->all();

        $coupons = collect($coupons)->pluck('id', 'name' );

        $couponID = array_first($coupons, fn($key, $value) => $value === $userCoupon);

//        dd($coupons, $couponID);


        return response()->json([
            'couponID' => $couponID
        ], Response::HTTP_OK);
    }
}
