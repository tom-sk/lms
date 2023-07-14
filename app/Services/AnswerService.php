<?php

namespace App\Services;

use App\Http\Requests\QuestionAnswerRequest;

class AnswerService
{
    public function store(array $data)
    {
        $user = auth()->user();
        $form = $data['formData'];

        foreach ($form as $key => $value) {
            if(array_key_exists('text_answer', $value)){
                $answerValue = $value['text_answer'];
            } else {
                $answerValue = $value['options_answer'];
            }

            $matchThese = ['question_id' => $value['id']];

            $user->answers()->updateOrCreate($matchThese, [
                'question_id' => $value['id'],
                'value' => json_encode($answerValue)
            ]);
        }

        return to_route('onboard.questions.page.two');
    }
}
