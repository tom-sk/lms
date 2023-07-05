<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Statamic\Facades\Entry;

class OnboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Onboard/CreateAccount', [
            'data' => Entry::findByUri('/onboard-page')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect()->route('onboard.payment');
    }

    public function questions()
    {
        return Inertia::render('Onboard/Questions');
    }

    public function payment()
    {
        return Inertia::render('Onboard/Payment', [
            'intent' => auth()->user()->createSetupIntent(),
        ]);
    }
}
