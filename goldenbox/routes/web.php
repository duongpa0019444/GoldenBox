<?php

<<<<<<< HEAD
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\loginController;
use App\Http\Controllers\client\HomeController;
=======
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\FileController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\client\loginController;
>>>>>>> 17d4d96a776f010598a17eafd006c45f04996fff
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Route;


<<<<<<< HEAD
Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('login', function () {
=======
Route::get('/', function () {
    return view('client.home');
})->name('home');

Route::get('login-admin', function () {
>>>>>>> 17d4d96a776f010598a17eafd006c45f04996fff
    return view('client.login');
});
Route::post('login', [loginController::class, 'login'])->name('admin.login');

<<<<<<< HEAD
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
=======

Route::middleware(['auth', AuthAdmin::class])->group(function() {
    //
    Route::get('admin/dashboard', [dashboardController::class, 'dashBoard'])->name('admin.dashboard');
    Route::get('admin/dashboard/chartturnover', [dashboardController::class, 'turnover']);
    Route::get('admin/dashboard/chartturnover/{id}', [dashboardController::class, 'turnoverProducts']);
    Route::get('/admin/orders/fetch', [dashboardController::class, 'fetchOrders']);
    Route::get('/admin/orders/search', [dashboardController::class, 'search']);


    Route::get('admin/dashboard', [dashboardController::class, 'dashBoard'])->name('admin.dashboard');
    Route::get('admin/dashboard/chartturnover', [dashboardController::class, 'turnover']);
    Route::get('/admin/orders/fetch', [dashboardController::class, 'fetchOrders']);
    Route::get('/admin//fetchorder', [dashboardController::class, 'fetchOrder']);
    Route::get('/admin/product/index', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/admin/product/detail/{id}', [ProductController::class, 'detail'])->name('admin.product.detail');
    Route::get('/admin/product/add', [ProductController::class, 'add'])->name('admin.products.add');
    Route::post('/upload-image', [FileController::class, 'uploadImage'])->name('admin.upload.image');
    Route::post('/delete-image', [FileController::class, 'deleteImage'])->name('admin.delete.image');



    Route::post('/admin/product/create', [ProductController::class, 'create'])->name('admin.product.create');

    Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/product/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');

    Route::get('/admin/product/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');

    Route::get('/admin/product/search', [ProductController::class, 'search'])->name('admin.product.search');

    Route::get('/admin/categories/index', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/add', [CategoryController::class, 'add'])->name('admin.categories.add');
    Route::post('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::get('/admin/categories/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');

    Route::delete('/clear-temp-folder', [FileController::class, 'clearTempFolder']);

>>>>>>> 17d4d96a776f010598a17eafd006c45f04996fff
});
