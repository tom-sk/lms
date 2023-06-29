<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $modules = Module::all();
        $userModules = $user->modules()->get();

        $modules->each(function ($module) use ($userModules) {
            $module->enrolled = $userModules->contains($module);
        });

        return Inertia::render('Dashboard', [
            'modules' => $modules
        ]);
    }
}
