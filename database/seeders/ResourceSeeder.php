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
        $urls = ['https://vimeo.com/783453158', 'https://vimeo.com/850892699', 'https://vimeo.com/850813479'];

        $videos = [
            [
                'title' => 'Video 1',
                'url' => $urls[0],
                'excerpt' => 'This is the excerpt',
            ],
            [
                'title' => 'Video 2',
                'url' => $urls[1],
                'excerpt' => 'This is the excerpt',
            ],
            [
                'title' => 'Video 3',
                'url' => $urls[2],
                'excerpt' => 'This is the excerpt',
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}
