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

    $this->get(route('onboard.questions.step-one'));

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

    $user = UserWithSubscription();

    $this->actingAs($user)
        ->followingRedirects()
        ->post(route('onboard.questions.step-one', $answerData ))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->component('Onboard/questions/QuestionsStepTwo')
                ->has('errors')
                ->where('errors', [])
        );

    expect($user->answers()->first()->id)->toBe($question1->id);
});
