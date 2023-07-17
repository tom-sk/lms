<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionAnswerRequest;
use App\Models\Onboard\Answer;
use App\Services\AnswerService;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private AnswerService $answerService)
    {
    }

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
        $this->answerService->store($request->validated());

        return to_route('onboard.questions.step-two');
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
