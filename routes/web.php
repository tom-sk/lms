<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\Onboard\OnboardController;
use App\Http\Controllers\Onboard\OnboardPaymentController;
use App\Http\Controllers\Onboard\QuestionsStepOneController;
use App\Http\Controllers\Onboard\QuestionsStepTwoController;
use App\Http\Controllers\SingleProductController;
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

Route::get('/onboard', OnboardController::class)->name('onboard');
Route::post('/onboard', [OnboardController::class, 'create'])->name('onboard.create');


Route::stripeWebhooks('/webhook');

Route::get('/purchase-success', [SingleProductController::class, 'success'])->name('product.checkout-success');
Route::get('/single-product/{product}', SingleProductController::class)->name('product-page');
Route::post('/single-payment', [SingleProductController::class, 'store'])->name('single.payment');
//Route::get('/single-product/{product}', GuestProductController::class)->name('product-page');

Route::get('/product/{product}', [SingleProductController::class, 'test'])->name('product-page');

Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');


Route::middleware('auth')->group(function () {
    Route::get('/onboard/payment', OnboardPaymentController::class)->name('onboard.payment');

    Route::post('/onboard/payment', [OnboardPaymentController::class, 'store'])->name('onboard.payment');

    Route::get('/onboard/questions/1', QuestionsStepOneController::class)->name('onboard.questions.step-one');
    Route::post('/onboard/questions/1', [QuestionsStepOneController::class, 'store'])->name('onboard.questions.step-one');

    Route::get('/onboard/questions/2', QuestionsStepTwoController::class)->name('onboard.questions.step-two');
    Route::post('/onboard/questions/2', [QuestionsStepTwoController::class, 'store'])->name('onboard.questions.step-two');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/enrol/{module}', [ModuleController::class, 'update'])->name('module.enrol');
    Route::get('/module/{module}', [ModuleController::class, 'show'])->name('module');
    Route::get('/module/{module}/topic/{topic}', [TopicController::class, 'show'])->name('module.topics');

    Route::get('/subscribe', [SubscriptionPaymentController::class, 'subscribe'])->name('subscribe');
    Route::post('/pay', [SubscriptionPaymentController::class, 'pay'])->name('pay');
});






require __DIR__.'/auth.php';
