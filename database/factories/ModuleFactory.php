<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModuleFactory extends Factory
{
    private static $order = 1;

    public function definition(): array
    {

        if(self::$order > 1) {
            $title = 'Module ';
        } else {
            $title = 'Being Business Ready  ';
        }


        return [
            'title' =>  $title . self::$order++,
            'content' => '[
                {
                    "type": "paragraph",
                    "content": [
                        {
                            "text": "Being Business Ready guides you through everything you will need to consider to ensure you are prepped and ready for the road ahead. ",
                            "type": "text"
                        }
                    ]
                }
            ]'
        ];
    }
}
