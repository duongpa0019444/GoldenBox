<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\loginController;
use App\Http\Controllers\client\HomeController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('login', function () {
    return view('client.login');
});
Route::post('login', [loginController::class, 'login'])->name('admin.login');

// Xử lí giỏ hàng
Route::post('/addToCart', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('/clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');// xóa toàn bộ giỏ hàng
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');
Route::post('/remove-cart', [CartController::class, 'removeFromCart'])->name('delete.cart');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CartController::class, 'checkout'])->name('place.order');
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');

Route::middleware(['auth', AuthAdmin::class])->group(function() {
    Route::get('admin/dashboard', [dashboardController::class, 'dashBoard'])->name('admin.dashboard');
    Route::get('admin/manager-order', [dashboardController::class, 'managerOrder'])->name('admin.order');
});
