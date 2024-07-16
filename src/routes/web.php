<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopManagerController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\PaymentController;

Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])->middleware(['auth'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::get('/admin/register', [AdminController::class, 'create'])->name('admin.register');
Route::post('admin/register', [AdminController::class, 'store']);
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/admin/shop-manager', [AdminController::class, 'storeShopManager'])->name('shop-manager.register');
});

Route::middleware(['auth', 'role:shop_manager'])->group (function(){
    Route::get('/shop_manager', [ShopManagerController::class, 'index'])->name('shop_manager.index');
    Route::post('shops/store', [ShopManagerController::class, 'store'])->name('shops.store');
    Route::put('/shop/{id}', [ShopManagerController::class, 'update'])->name('shop.update');
    Route::get('/email/form/{userId}',[ShopManagerController::class, 'showForm'])->name('email_form');
    Route::post('/email/send/{userId}', [ShopManagerController::class, 'sendEmail'])->name('send_email');
});


Route::get('/', [ShopController::class, 'index']);
Route::get('/search', [ShopController::class, 'search']);
Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('shop.detail');

Route::get('/thanks', function () {
    return view('auth.thanks');
});

Route::get('/menu', [AuthController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::post('/confirm', [ReservationController::class, 'confirm'])->name('confirm');
    Route::post('/done', [ReservationController::class, 'store'])->name('done');
    Route::get('my_page', [UserController::class, 'myPage'])->name('my_page');
    Route::get('reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('delete');
    Route::post('/favorite/toggle', [FavoriteController::class, 'toggle']);
    Route::get('review_edit/{reservation}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reservations/{id}/qrcode', [ReservationController::class, 'show'])->name('qrcode');
    Route::get('payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('payment/charge', [PaymentController::class, 'charge'])->name('payment.charge');
});
