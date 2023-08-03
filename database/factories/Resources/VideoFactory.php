<?php

namespace Database\Factories\Resources;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => 'What made you want to start your own business?',
            'excerpt' => 'This is the excerpt',
            'url' => 'https://player.vimeo.com/video/782293431?h=3962ee6b28&badge=0&autopause=0&player_id=0&app_id=58479',
            'thumbnail' => 'computer-table.png',
            'industry' => 'test-industry',
        ];
    }
}
