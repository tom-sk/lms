<?php

namespace App\Http\Controllers\Onboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionAnswerRequest;
use App\Models\Onboard\Question;
use App\Services\AnswerService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionsStepOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private AnswerService $answerService)
    {
    }

    public function __invoke()
    {
        $answers = auth()->user()->formattedAnswers();

        $questions = Question::findMany([1,2,3,4])
            ->map(function ($question) {
                return [
                    'id' => $question->id,
                    'title' => $question->title,
                    'type' => $question->type,
                    'options' => json_decode($question->options),
                ];
            });

        return Inertia::render('Onboard/questions/QuestionsStepOne',[
            'questions' => $questions,
            'answers' => $answers,
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
        $this->answerService->store($request->validated());

        return to_route('onboard.questions.step-two');
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
