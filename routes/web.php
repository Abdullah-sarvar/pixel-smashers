<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;

// ============================================================
// Public Routes
// ============================================================

Route::get('/', function () { return view('welcome'); });

Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// ============================================================
// Guest-only Routes (redirects to / if already logged in)
// ============================================================

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Forgot Password
    Route::get('/forgot-password',  [PasswordResetController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

    // Reset Password (arrived via signed email link)
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password',        [PasswordResetController::class, 'resetPassword'])->name('password.update');

});

// ============================================================
// Authenticated Routes
// ============================================================

Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Cart
    Route::get('/cart',              [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{id}',    [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout',    [CartController::class, 'checkout'])->name('cart.checkout');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');

    // Reviews
    Route::post('/review/{id}', [ReviewController::class, 'store'])->name('review.store');

    // Seller
    Route::get('/seller/dashboard',    [SellerDashboardController::class, 'index'])->name('seller.dashboard');
    Route::get('/seller/upload',       [SellerDashboardController::class, 'create'])->name('seller.upload');
    Route::post('/seller/upload',      [SellerDashboardController::class, 'store'])->name('seller.store');
    Route::get('/seller/edit/{id}',    [SellerDashboardController::class, 'edit'])->name('seller.edit');
    Route::put('/seller/edit/{id}',    [SellerDashboardController::class, 'update'])->name('seller.update');
    Route::delete('/seller/delete/{id}', [SellerDashboardController::class, 'destroy'])->name('seller.destroy');

    // Admin
    Route::get('/admin/dashboard',       [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/user/{id}',    [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::delete('/admin/product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteProduct');

});