<?php

namespace App\DataTransferObjects;

class SubscriptionData
{
    public function __construct(
        public string $productId,
        public string $paymentMethod,
        public ?string $coupon
    ) {
    }

}
