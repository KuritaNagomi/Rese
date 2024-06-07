<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;


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
    Route::get('my_page', [UserController::class, 'myPage']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('delete');
    Route::post('/favorite/toggle', [FavoriteController::class, 'toggle']);
});