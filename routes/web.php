<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\OnboardController;
use App\Http\Controllers\PageController;
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

Route::get('/onboard', [OnboardController::class, 'index'])->name('onboard');
Route::post('/onboard', [OnboardController::class, 'store'])->name('onboard.store');


Route::middleware('auth')->group(function () {
    Route::get('/onboard/payment', [OnboardController::class, 'payment'])->name('onboard.questions');
    Route::get('/onboard/questions', [OnboardController::class, 'questions'])->name('onboard.questions');
    Route::get('/onboard/payment', [OnboardController::class, 'payment'])->name('onboard.payment');
    Route::post('/onboard/payment', [PaymentController::class, 'payOnboard'])->name('onboard.payment');


    Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');
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
