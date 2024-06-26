<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Models\Product;

// Authentication View Routes
Route::view('/registration', 'pages.auth.registration-page')->name('registration');
Route::view('/login', 'pages.auth.login-page')->name('login');
Route::view('/send-otp', 'pages.auth.send-otp-page')->name('sendOTP');
Route::view('/verify-otp', 'pages.auth.verify-otp-page');


// Authentication API Routes
Route::post('/registration', [UserController::class, 'registration']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/send-otp', [UserController::class, 'sendOTP']);
Route::post('/verify-otp', [UserController::class, 'verifyOTP']);

// Authentication Middleware Routes
Route::middleware([TokenVerificationMiddleware::class])->group(function () {
    Route::view('/profile', 'pages.dashboard.profile-page')->name('profile');
    Route::view('/reset-password', 'pages.auth.reset-pass-page');
    Route::get('/profile-details', [UserController::class, 'profileDetails']);
    Route::post('/update', [UserController::class, 'updateProfile']);
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/reset-password', [UserController::class, 'resetPassword']);
});


// Category web and API Routes
Route::middleware([TokenVerificationMiddleware::class])->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category-create', [CategoryController::class, 'create']);
    Route::get('/category-list', [CategoryController::class, 'list']);
    Route::post('/category-details', [CategoryController::class, 'details']);
    Route::post('/category-update', [CategoryController::class, 'update']);
    Route::post('/category-delete', [CategoryController::class, 'delete']);
});

// Customer web and API Routes
Route::middleware([TokenVerificationMiddleware::class])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('/customer-create', [CustomerController::class, 'create']);
    Route::get('/customer-list', [CustomerController::class, 'list']);
    Route::post('/customer-details', [CustomerController::class, 'details']);
    Route::post('/customer-update', [CustomerController::class, 'update']);
    Route::post('/customer-delete', [CustomerController::class, 'delete']);
});

// Product and API Routes
Route::middleware([TokenVerificationMiddleware::class])->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/product-create', [ProductController::class, 'create']);
    Route::get('/product-list', [ProductController::class, 'list']);
    Route::post('/product-details', [ProductController::class, 'details']);
    Route::post('/product-update', [ProductController::class, 'update']);
    Route::post('/product-delete', [ProductController::class, 'delete']);
    Route::post('/add-quantity', [ProductController::class, 'addQty']);
});

// Invoice and API Routes
Route::middleware([TokenVerificationMiddleware::class])->group(function () {
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/sale', [InvoiceController::class, 'salePage'])->name('sale');
    Route::post('/invoice-create', [InvoiceController::class, 'create']);
    Route::post('/invoice-details', [InvoiceController::class, 'details']);
    Route::get('/invoice-list', [InvoiceController::class, 'list']);
    Route::post('/invoice-delete', [InvoiceController::class, 'delete']);
});


// Summery  and Report
Route::middleware([TokenVerificationMiddleware::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/summery', [DashboardController::class, 'summery']);
    Route::get("/report", [ReportController::class, 'index'])->name('report');
    Route::get("/sales-report/{fromDate}/{toDate}", [ReportController::class, 'salesReport']);
});
