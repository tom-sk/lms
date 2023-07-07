<?php

namespace Database\Factories\Onboard;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class QuestionFactory extends Factory
{
    private static $order = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $options = ['text', 'textarea', 'radio', 'mutliselect'];

        $type = $options[self::$order - 1];

        $options = null;

        if($type === 'radio' || $type === 'mutliselect'){
            $options = ['Yes', 'No'];
        }

        return [
            'type' => $type,
            'title' => 'Question' . self::$order++,
            'options' => json_encode($options)
        ];
    }
}
