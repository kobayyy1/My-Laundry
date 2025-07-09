<?php

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;
use App\Http\Middleware\adminAuthenticate;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\customerController;
use App\Http\Controllers\admin\orderController;
use App\Http\Controllers\auth\userAuthController;
use App\Http\Controllers\pages\productController;
use App\Http\Controllers\auth\adminAuthController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\productAdminController;
use App\Http\Controllers\admin\profileAdminController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\forgotpasswordcontroller;
use App\Http\Controllers\admin\transactionAdminController;
use App\Http\Controllers\pages\CheckoutController;
use App\Http\Controllers\pages\CartController;
use App\Http\Controllers\pages\orderdetailController;
use App\Http\Controllers\user\userOrderController;
use App\Http\Controllers\user\userProfileController;

// ROUTING USERS
Route::get('/', [indexController::class, 'index']);
Route::get('/home', [indexController::class, 'index'])->name('index');
Route::get('/about', [indexController::class, 'about'])->name('about');
Route::get('/product', [indexController::class, 'product'])->name('product');
Route::get('/about/tentang', [indexController::class, 'tentang'])->name('tentang');
Route::get('/about/layanan', [indexController::class, 'layanan'])->name('layanan');
Route::get('/about/carakerja', [indexController::class, 'kerja'])->name('carakerja');
Route::get('/about/faq', [indexController::class, 'faq'])->name('faq');
Route::get('/about/kontakkami', [indexController::class, 'kontak'])->name('kontak');
Route::get('/about/keunggulankami', [indexController::class, 'keunggulan'])->name('keunggulan');


// CART
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/orderdetail/{id}', [orderdetailController::class, 'orderdetail'])->name('order.detail');



// AUTHENTICATE
Route::get('/login', [userAuthController::class, 'login'])->name('login');
Route::get('/signup', [userAuthController::class, 'signup'])->name('signup');
Route::post('/signup/post', [userAuthController::class, 'signuppost'])->name('signup.post');



// PRODUCT_ORDER
Route::get('/product/order/{id}/{slug}', [productController::class, 'order'])->name('product.order');
Route::get('/product/order/delete/{id}/{slug}', [productController::class, 'orderDelete'])->name('product.order.delete');


// FORGOT AND RESET
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [forgotpasswordcontroller::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// ROUTING ADMIN
Route::get('/admin/login', [adminAuthController::class, 'login'])->name('admin.login');

Route::prefix('admin')->middleware([adminAuthenticate::class])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [profileAdminController::class, 'index'])->name('admin.profile');
    Route::get('/profile/detail/{id}', [profileAdminController::class, 'admindetail'])->name('admin.profile.detail');
    Route::get('/logout', [adminController::class, 'logout'])->name('admin.logout');

    // CUSTOMERS ROURING
    Route::get('/customer', [customerController::class, 'customer'])->name('admin.customer');
    Route::get('/customer/detail/{id}', [customerController::class, 'customerdetail'])->name('admin.customer.detail');

    // ACCOUNT ROUTING
    Route::get('/account', [adminController::class, 'index'])->name('admin.account');
    Route::get('/account/create', [adminController::class, 'create'])->name('admin.account.create');
    Route::post('/account/create/post', [adminController::class, 'createPost'])->name('admin.account.create.post');
    Route::get('/account/update/{id}', [adminController::class, 'update'])->name('admin.account.update');
    Route::put('/account/update/{id}/post', [adminController::class, 'updatePost'])->name('admin.account.update.post');

    // PRODUCT ROUTING
    Route::get('/product', [productAdminController::class, 'data'])->name('admin.product');
    Route::get('/product/create', [productAdminController::class, 'create'])->name('admin.product.create');
    Route::get('/product/detail/{id}', [productAdminController::class, 'detail'])->name('admin.product.detail');
    Route::post('/product/create/post', [productAdminController::class, 'createPost'])->name('admin.product.create.post');
    Route::get('/product/update/{id}', [productAdminController::class, 'update'])->name('admin.product.update');
    Route::put('/product/update/post/{id}', [productAdminController::class, 'updatePost'])->name('admin.product.update.post');

    // TRANSACTION ROUTING
    Route::get('transaction', [transactionAdminController::class, 'index'])->name('admin.transaction');


    Route::get('/order', [orderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/update/{id}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::put('/orders/update/post/{id}', [OrderController::class, 'updatepost'])->name('admin.orders.update.post');
    Route::get('/orders/delete/{id}', [OrderController::class, 'delete'])->name('admin.orders.delete');
    Route::post('/order/upload', [orderController::class, 'uploadFile'])->name('admin.orders.upload');
    Route::get('/order/detail{id}', [orderController::class, 'detailorder'])->name('admin.orders.detail');
    // routes/web.php
    Route::get('/orders/{id}/download', [OrderController::class, 'downloadInvoice'])->name('admin.orders.download');
    Route::get('/orders/{id}/pdf', [OrderController::class, 'viewInvoicePDF'])->name('admin.orders.pdf');
    Route::get('/orders/{id}/print', [OrderController::class, 'printOrder'])->name('admin.orders.print');
});



// ROUTING_USERS
Route::prefix('user')->middleware(['auth.user'])->group(function () {
    // PROFILE
    Route::get('/profile', [userProfileController::class, 'index'])->name('profile');
    Route::get('/profile/update', [userProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update/post', [userProfileController::class, 'updatepost'])->name('profile.update.post');
    Route::put('/profile/avatar', [userProfileController::class, 'updateAvatar'])->name('profile.avatar');

    // ORDER
    Route::get('/pesanan', [userOrderController::class, 'order'])->name('user.order');



    Route::get('/logout', [userProfileController::class, 'logout'])->name('logout');
});







// Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
// Route::get('/send-test-email', function () {
//     Mail::to('bilnet18@gmail.com')->send(new App\Mail\TestDoang());
//     return 'Email sent!';
// });