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
        $coupons = $stripe->promotionCodes->all();

        $coupons = collect($coupons)->map(function ($coupon) {
            return [
                'id' => $coupon['id'],
                'code' => $coupon['code'],
            ];
        });

        $couponID = $coupons->where('code', $userCoupon)->first();

        if($couponID !== null){
            return response()->json([
                'couponID' => $couponID['id']
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'couponID' => false
            ], Response::HTTP_NO_CONTENT);
        }

    }
}
