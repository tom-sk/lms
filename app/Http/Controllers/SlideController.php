<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlideUpdateRequest;
use App\Models\Module;
use App\Models\Slide;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\json;

class SlideController extends Controller
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
    public function show(Slide $slide)
    {
       return response()->json([
            'message' => 'hello'
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slide $slide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SlideUpdateRequest $request)
    {
        $user = Auth::user();
        $requestData = $request->toDto();

//        Create the data for the pivot table sync
        if(!is_null($requestData->slideComplete) && $requestData->slideComplete) {
            $data = [$requestData->slideId => ['slide_complete' => $requestData->slideComplete]];
        } else {
            $data = $requestData->slideId;
        }

        $user->slides()->syncWithoutDetaching($data);

//        Return the updated slides
        $topic = Topic::find($requestData->topicId);
        $slides = $topic->slides()->get();

        $userSlides = $user->completedSlides()->get();

        $slides->each(function ($slide) use ($userSlides) {
            $slide['slide_complete'] = $userSlides->contains($slide);
        });

        $moduleProgress = Module::find($requestData->moduleId)->progress();

        return response()->json([
            'slides' => $slides,
            'moduleProgress' => $moduleProgress,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slide $slide)
    {
        //
    }
}
