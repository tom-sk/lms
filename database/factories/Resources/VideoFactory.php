<?php

namespace Database\Factories\Resources;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    public function definition(): array
    {
        $urls = ['https://vimeo.com/783453158', 'https://vimeo.com/850892699', 'https://vimeo.com/850813479'];

        return [
            'title' => $this->faker->words(3, true),
            'excerpt' => 'This is the excerpt',
            'url' => $this->faker->randomElement($urls),
            'thumbnail' => 'computer-table.png',
            'industry' => 'test-industry',
        ];
    }
}
