<?php

namespace App\Http\Controllers\Onboard;

use App\Http\Controllers\Controller;
use App\Models\Onboard\Question;
use App\Services\AnswerService;
use Inertia\Inertia;

class QuestionsStepTwoController extends Controller
{
    public function __construct(private AnswerService $answerService)
    {
    }

    public function __invoke()
    {
        $questions = Question::findMany([5,6,7,8])
            ->map(function ($question) {
                return [
                    'id' => $question->id,
                    'title' => $question->title,
                    'type' => $question->type,
                    'options' => json_decode($question->options),
                ];
            });

        return Inertia::render('Onboard/questions/QuestionsStepTwo',[
            'questions' => $questions,
            'answers' => auth()->user()->formattedAnswers(),
        ]);
    }

    public function store()
    {
        $this->answerService->store(request()->all());

        return redirect()->route('dashboard')->with(['success' => 'Welcome! Subscription Created!!']);
    }
}
