<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TopicFactory extends Factory
{
    private static $order = 1;

    public function definition(): array
    {
        return [
            'title' => 'Topic ' . self::$order++,
        ];
    }

}
