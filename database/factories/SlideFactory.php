<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SlideFactory extends Factory
{
    private static $order = 1;

    public function definition(): array
    {
        return [
            'title' => 'Slide ' . self::$order++,
        ];
    }

}
