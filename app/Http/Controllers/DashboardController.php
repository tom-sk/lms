<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Statamic\Facades\Entry;
use Label84\ActiveCampaign\ActiveCampaign;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */

    public function __invoke()
    {

        $data = Entry::query()
            ->where('collection', 'app_pages')
            ->where('slug', 'dashboard')
            ->first();

        $user = Auth::user();

        $modules = Module::all();
        $userModules = $user->modules()->get();

        $modules->each(function ($module) use ($userModules) {
            $module['enrolled'] = $userModules->contains($module);
            $module['progress'] = $module->progress();
            $module['topics'] = $module->topics()->get();
        });

        return Inertia::render('Dashboard', [
            'modules' => $modules,
            'content' => $data->content
        ]);

//        ->with(['flash.success' => 'Subscription Created!!']);
    }

    public function index()
    {

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
