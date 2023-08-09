<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Onboard\Question;
use App\Models\Resources\Video;
use App\Models\Slide;
use App\Models\Topic;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factory = new UserFactory();

        $factory->createUser('thomasscullyking@hotmail.com', 1);

        Module::factory()
            ->count(6)
            ->has(
                Topic::factory()
                    ->count(3)
                    ->has(
                        Slide::factory()
                            ->count(3)
                    )
                    ->hasVideos(3)

            )
            ->create();

        Question::factory()
            ->count(10)
            ->create();
    }
}
