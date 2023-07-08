<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\Onboard\OnboardController;
use App\Http\Controllers\Onboard\OnboardPaymentController;
use App\Http\Controllers\Onboard\OnboardQuestionsController;
use App\Http\Controllers\PaymentController;
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


Route::middleware('auth')->group(function () {
    Route::get('/onboard/payment', OnboardPaymentController::class)->name('onboard.payment');
    Route::post('/onboard/payment', [OnboardPaymentController::class, 'store'])->name('onboard.payment');
    Route::get('/onboard/questions', OnboardQuestionsController::class)->name('onboard.questions');
    Route::post('/onboard/questions', [AnswersController::class, 'store'])->name('onboard.questions');


    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/enrol/{module}', [ModuleController::class, 'update'])->name('module.enrol');
    Route::get('/module/{module}', [ModuleController::class, 'show'])->name('module');
    Route::get('/module/{module}/topic/{topic}', [TopicController::class, 'show'])->name('module.topics');

    Route::get('/subscribe', [PaymentController::class, 'subscribe'])->name('subscribe');
    Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');
});




require __DIR__.'/auth.php';
