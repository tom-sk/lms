<?php

namespace Database\Seeders;

use App\Models\Resources\Video;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::factory()
            ->create([
                'title' => 'What made you want to start your own business?',
                'excerpt' => 'This is the excerpt',
                'url' => 'https://player.vimeo.com/video/782293431?h=3962ee6b28&badge=0&autopause=0&player_id=0&app_id=58479',
                'thumbnail' => 'computer-table.png',
                'industry' => 'test-industry',
            ]);
    }
}
