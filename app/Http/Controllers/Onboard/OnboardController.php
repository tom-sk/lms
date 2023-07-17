<?php

namespace App\Http\Controllers\Onboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Statamic\Facades\Entry;

class OnboardController extends Controller
{
    public function __invoke()
    {

//        $data = Entry::query()
//            ->where('collection', 'pages')
//            ->where('slug', 'onboard-page')
//            ->first();

        /** @phpstan-ignore-next-line */
        $data = Entry::findByUri('/onboard-page');

        return Inertia::render('Onboard/CreateAccount', [
            'data' => $data
        ]);
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


    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
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
