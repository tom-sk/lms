<?php

namespace App\Http\Controllers\Onboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Product;
use App\Services\SubscriptionPaymentService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OnboardPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct(private SubscriptionPaymentService $subscriptionPaymentService )
    {
    }
    public function __invoke()
    {
        return Inertia::render('Onboard/Payment', [
            'intent' => auth()->user()->createSetupIntent(),
            'products' => Product::where('type', 'subscription')->get()
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
        $this->subscriptionPaymentService->create($request->toDto());

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
