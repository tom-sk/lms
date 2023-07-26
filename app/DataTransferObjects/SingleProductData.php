<?php

namespace App\DataTransferObjects;

class SingleProductData
{
    public function __construct(
        public string $productId,
        public string $email,
        public string $paymentMethod,
    ) {
    }
}
