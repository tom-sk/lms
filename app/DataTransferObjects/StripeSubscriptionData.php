<?php

namespace App\DataTransferObjects;

class StripeSubscriptionData
{
    public function __construct(
        public string $id,
    ) {
    }

}
