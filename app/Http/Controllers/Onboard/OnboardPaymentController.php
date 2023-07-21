<?php

namespace App\Http\Controllers\Onboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OnboardPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __invoke()
    {
        return Inertia::render('Onboard/Payment', [
            'intent' => auth()->user()->createSetupIntent(),
            'products' => Product::all()
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
    public function store(PaymentRequest $request)
    {
        $validated = $request->safe()->all();

        auth()->user()->newSubscription('cashier', $validated['productId'])
            ->create($validated['paymentMethod']);

//        return Inertia::render('Onboard/questions/Questions')->with(['flash.success' => 'Subscripbtion Created!!']);

        return to_route('onboard.questions.step-one');
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
