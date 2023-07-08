<?php

namespace App\Http\Controllers\Onboard;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {

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
