<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Module;
use App\Models\Onboard\Answer;
use App\Models\Onboard\Question;
use App\Models\Slide;
use App\Models\Topic;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
            )
            ->create();

        Question::factory()
            ->count(2)
            ->create();
    }
}
