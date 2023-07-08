<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionAnswerRequest;
use App\Models\Onboard\Answer;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

            $matchThese = ['question_id' => $value['id']];

            $user->answers()->updateOrCreate($matchThese, [
                'question_id' => $value['id'],
                'value' => json_encode($answerValue)
            ]);
        }

        return to_route('onboard.questions');
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
