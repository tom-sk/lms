<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Slide;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TopicController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module, Topic $topic, Slide $slide)
    {
        $user = Auth::user();
        $slide = $topic->slides()->first();

        $slides = $topic->slides()->get();

        $userSlides = $user->completedSlides()->get();

        $slides->each(function ($slide) use ($userSlides) {
            $slide->slide_complete = $userSlides->contains($slide);
        });

        $activeSlideIndex = array_search(false, array_column($slides->toArray(), 'slide_complete'));

        return Inertia::render('Topic/index', [
            'module' => $module,
            'topic' => $topic,
            'topics' => $module->topics()->get(),
            'slide' => $slides[$activeSlideIndex],
            'slides' => $slides,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
