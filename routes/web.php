<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SingleSkipController;
use App\Http\Controllers\SkipListController;
use App\Http\Controllers\MyListController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\MailController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/singleSkip', [SingleSkipController::class, 'index'])->name('singleSkip');
    Route::post('/singleSkip', [SingleSkipController::class, 'store']);
    Route::get('/skipList', [SkipListController::class, 'index'])->name('skipList');
    Route::post('/skipList', [SkipListController::class, 'import'])->name('skipList');
    Route::get('/csvList', [MyListController::class, 'index'])->name('csvList');
    Route::get('/myList/{id}', [MyListController::class, 'mylist_csv'])->name('myList');
    Route::get('/addCard', [StripePaymentController::class, 'addCard'])->name('addCard');
    Route::post('/addCard', [StripePaymentController::class, 'addCardPost'])->name('addCardPost');
    Route::get('/billing_history', [StripePaymentController::class, 'billing_history'])->name('billing_history');
    Route::get('/manage_cards', [StripePaymentController::class, 'manage_cards'])->name('manage_cards');
    Route::post('/deleteCard', [StripePaymentController::class, 'deleteCard']);
    Route::post('/editCard', [StripePaymentController::class, 'editCard']);
    Route::get('/add_credits', [StripePaymentController::class, 'buy_skips'])->name('add_credits');
    Route::post('/add_credits', [StripePaymentController::class, 'buy_skips_Post'])->name('buy_skips');
    Route::get('/change_password', [SettingsController::class, 'index'])->name('change_password');
    Route::post('/change_password', [SettingsController::class, 'change_password_post']);
    Route::get('/contact', [SettingsController::class, 'contact']);
    Route::post('/contact', [SettingsController::class, 'store'])->name('contact');
    Route::get('/send-mail', [MailController::class, 'index']);

});

require __DIR__.'/auth.php';
