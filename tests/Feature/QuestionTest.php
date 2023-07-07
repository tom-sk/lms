<?php

use App\Models\Module;
use App\Models\Onboard\Question;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

test('Question can have answers', function () {

    $question1 = Question::create([
        'title' => 'Question 1',
        'type' => 'text',
        'options' => json_encode(['Yes', 'No']),
    ]);

    $question2 = Question::create([
        'title' => 'Question 1',
        'type' => 'text',
        'options' => json_encode(['Yes', 'No']),
    ]);

    $this->get(route('onboard.questions'));
    $answerData = [
        "formData" => [
            [
                "text_answer" => 'the text answer',
                "type" => "text",
                "id" => $question1->id
            ],
            [
                "options_answer" => ['one', 'two'],
                "type" => "multiselect",
                "id" => $question2->id
            ]
        ]
    ];

    $user = User::create([
        'name' => fake()->name(),
        'email' => fake()->email(),
    ]);

    $this->actingAs($user)
        ->followingRedirects()
        ->post(route('onboard.questions', $answerData ))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->component('Onboard/Questions')
                ->has('errors')
                ->where('errors', [])
        );

    expect($user->answers()->first()->id)->toBe($question1->id);
});
