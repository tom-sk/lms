<?php

namespace App\DataTransferObjects;

class SingleProductData
{
    public function __construct(
        public string $id,
        public string $title,
        public string $price,
    ) {
    }
}
