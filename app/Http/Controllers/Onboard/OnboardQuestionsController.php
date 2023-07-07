<?php

namespace App\Http\Controllers\Onboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionAnswerRequest;
use App\Models\Onboard\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OnboardQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __invoke()
    {
        $questions = Question::get()
            ->map(function ($question) {
                return [
                    'id' => $question->id,
                    'title' => $question->title,
                    'type' => $question->type,
                    'options' => json_decode($question->options),
                    'answer' => $question->answers()->get()->map(function ($answer) {
                        return [
                            'value' => json_decode($answer->pivot->value),
                        ];
                    }),
                ];
            });

        return Inertia::render('Onboard/Questions',[
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionAnswerRequest $request)
    {
        $user = auth()->user();
        $data = $request->safe()->all()['formData'];


        foreach ($data as $key => $value) {
            if(array_key_exists('text_answer', $value)){
                $answerValue = $value['text_answer'];
            } else {
                $answerValue = $value['options_answer'];
            }

            $user->attachQuestion(Question::find($value['id']), $answerValue );
        }

        return to_route('onboard.questions');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
