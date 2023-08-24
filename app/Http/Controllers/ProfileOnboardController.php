<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionAnswerRequest;
use App\Models\Onboard\Question;
use App\Services\AnswerService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProfileOnboardController extends Controller
{
    public function __construct(private AnswerService $answerService)
    {
    }

    public function edit(Request $request): Response
    {
        $answers = auth()->user()->formattedAnswers();

        $questions = Question::get()
            ->map(function ($question) {
                return [
                    'id' => $question->id,
                    'title' => $question->title,
                    'type' => $question->type,
                    'options' => json_decode($question->options),
                ];
            });

        return Inertia::render('Profile/EditOnboard', compact('answers', 'questions'));
    }

    public function store(QuestionAnswerRequest $request)
    {
        $this->answerService->store($request->validated());

        return redirect()->route('profile.onboard.edit')->with(['success' => 'Questions updated']);
    }
}
