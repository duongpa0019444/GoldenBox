<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\client\loginController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('client.home');
})->name('home');

Route::get('login-admin', function () {
    return view('client.login');
});
Route::post('login', [loginController::class, 'login'])->name('admin.login');


Route::middleware(['auth', AuthAdmin::class])->group(function() {
    Route::get('admin/dashboard', [dashboardController::class, 'dashBoard'])->name('admin.dashboard');
    Route::get('admin/dashboard/chartturnover', [dashboardController::class, 'turnover']);
    Route::get('/admin/orders/fetch', [dashboardController::class, 'fetchOrders']);

});
