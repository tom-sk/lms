<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\Onboard\OnboardController;
use App\Http\Controllers\Onboard\OnboardPaymentController;
use App\Http\Controllers\Onboard\QuestionsStepOneController;
use App\Http\Controllers\Onboard\QuestionsStepTwoController;
use App\Http\Controllers\ProfileOnboardController;
use App\Http\Controllers\ProfileProductsController;
use App\Http\Controllers\SingleProductController;
use App\Http\Controllers\SubCheckoutController;
use App\Http\Controllers\SubscriptionPaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Webhooks
Route::stripeWebhooks('/webhook');

// Public onboarding routes
Route::get('/onboard', OnboardController::class)->name('onboard');
Route::post('/onboard', [OnboardController::class, 'create'])->name('onboard.create');

Route::get('/purchase-success', [SingleProductController::class, 'success'])->name('product.checkout-success');

Route::get('/product/{product}', SingleProductController::class)->name('product-page');

Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');



Route::middleware(['auth'])->group(function () {
//     Onboarding
    Route::get('/onboard/payment', OnboardPaymentController::class)->name('onboard.payment');
    Route::post('/onboard/payment', [OnboardPaymentController::class, 'store'])->name('onboard.payment');

});

Route::middleware(['auth', 'subscribed'])->group(function () {
//
    Route::get('/sub-checkout', SubCheckoutController::class)->name('sub-checkout');
    Route::get('/sub-checkout/success', [SubCheckoutController::class, 'success'])->name('sub-checkout.success');
    Route::get('/sub-checkout/cancel', [SubCheckoutController::class, 'cancel'])->name('sub-checkout.cancel');

//     Onboarding
    Route::get('/onboard/questions/1', QuestionsStepOneController::class)->name('onboard.questions.step-one');
    Route::post('/onboard/questions/1', [QuestionsStepOneController::class, 'store'])->name('onboard.questions.step-one');
    Route::get('/onboard/questions/2', QuestionsStepTwoController::class)->name('onboard.questions.step-two');
    Route::post('/onboard/questions/2', [QuestionsStepTwoController::class, 'store'])->name('onboard.questions.step-two');

//    Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/products', [ProfileProductsController::class, 'edit'])->name('profile.products');
    Route::get('/profile/onboard', [ProfileOnboardController::class, 'edit'])->name('profile.onboard.edit');
    Route::post('/profile/onboard', [ProfileOnboardController::class, 'store'])->name('profile.onboard.update');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/enrol/{module}', [ModuleController::class, 'update'])->name('module.enrol');

//    Module
    Route::get('/module/{module}', [ModuleController::class, 'show'])->name('module');
    Route::get('/module/{module}/topic/{topic}', [TopicController::class, 'show'])->name('module.topics');

//    Subscription
    Route::get('/subscribe', [SubscriptionPaymentController::class, 'subscribe'])->name('subscribe');
    Route::post('/pay', [SubscriptionPaymentController::class, 'pay'])->name('pay');
});







require __DIR__.'/auth.php';
