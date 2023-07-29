<?php

namespace App\DataTransferObjects;

class ProductData
{
    public function __construct(
        public string $id,
        public string $title,
        public string $stripe_id,
        public string $type,
        public string $price,
    ) {
    }
}
