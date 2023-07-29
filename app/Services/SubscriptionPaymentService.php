<?php

namespace App\Services;

use App\DataTransferObjects\SubscriptionData;

class SubscriptionPaymentService
{
    public function create(SubscriptionData $subscriptionData){
        if(!empty($subscriptionData->coupon)){

            auth()->user()->newSubscription('essential', $subscriptionData->productId)
                ->withPromotionCode($subscriptionData->coupon)
                ->create($subscriptionData->paymentMethod);

        } else {

            auth()->user()->newSubscription('essential', 'price_1NZI5HBmxT5gIh6ph91MRYo8')
                ->create($subscriptionData->paymentMethod);

        }
    }
}
