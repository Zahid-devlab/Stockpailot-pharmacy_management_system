<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('home/home');
});
Route::get('/about', function () {
    return Inertia::render('about/about');
});




Route::get('/login', [UserController::class, 'loginPage'])->name('login');

Route::get('/registration', [UserController::class, 'registrationPage'])->name('registration');

Route::post('/user-registration', [UserController::class, 'userRegistration']);

Route::post('/user-login', [UserController::class, 'userLogin']);

Route::get('/user-logout', [UserController::class, 'userLogout']);

Route::post('/user-send-otp', [UserController::class, 'userSendOtp']);


Route::middleware([AuthMiddleware::class])->group(function () {

        Route::get('/user-dashboard', [DashboardController::class, 'dashboardPage'])->name('dashboard');


        //Customer Route
        Route::get('/customers', [CustomerController::class, 'customerPage'])->name('customer');
        Route::get('/customer-crate', [CustomerController::class, 'customerCreatePage'])->name('customer-create');
        Route::get('/customer-edit/{id}', [CustomerController::class, 'customerEditPage'])->name('customer-edit');



        //User Route
        Route::get('/user-profile',[ProfileController::class,'profilePage']);
        Route::post('/user-update-profile', [ProfileController::class, 'userUpdateProfile']);

        //Category Route
        Route::get('/category', [CategoryController::class, 'categoryPage'])->name('category');
        Route::post('/user-category-create', [CategoryController::class, 'userCategoryCreate']);
        Route::get('/user-category-list', [CategoryController::class, 'userCategoryList']);
        Route::post('/user-category-update/{id}', [CategoryController::class, 'userCategoryUpdate']);
        Route::delete('/user-category-delete/{id}', [CategoryController::class, 'userCategoryDelete']);
        Route::post('/user-category-by-id/{id}', [CategoryController::class, 'userCategoryById']);

        // Custom Route

        Route::post('/user-customer-create', [CustomerController::class, 'userCustomerCreate']);
        Route::get('/user-customer-list', [CustomerController::class, 'userCustomerList']);
        Route::post('/user-customer-update', [CustomerController::class, 'userCustomerUpdate']);
        Route::delete('/user-customer-delete/{id}', [CustomerController::class, 'userCustomerDelete']);
        Route::post('/user-customer-by-id', [CustomerController::class, 'userCustomerById']);

        //Product Route

        Route::get('/products', [ProductController::class, 'productPage'])->name('products');
        Route::get('/product-edit/{id}', [ProductController::class, 'productEditPage'])->name('product-edit');
        Route::post('/user-product-create', [ProductController::class, 'userProductCreate']);
        Route::post('/user-product-update', [ProductController::class, 'userProductUpdate']);
        Route::get('/user-product-list', [ProductController::class, 'userProductList']);
        Route::post('/user-product-by-id', [ProductController::class, 'userProductById']);
        Route::delete('/user-product-delete', [ProductController::class, 'userProductDelete']);

        //Invoice Route

        Route::get('/sale', [InvoiceController::class, 'salePage'])->name('invoice');
        Route::post('/user-invoice-create', [InvoiceController::class, 'invoiceCreate']);
        Route::get('/user-invoice-select/{id}', [InvoiceController::class, 'invoiceSelect']);
        Route::delete('/user-invoice-delete', [InvoiceController::class, 'invoiceDelete']);
        Route::post('/user-invoice-details', [InvoiceController::class, 'invoiceDetails']);
        Route::get('/invoice', [InvoiceController::class, 'invoicePage'])->name('invoice');

        //Report Route
        Route::get('/report', [ReportController::class, 'reportPage'])->name('report');
        Route::get('sales-report/{from}/{to}', [ReportController::class, 'saleReport'])->name('sale-report');

        Route::put('/user-invoice-dues-update', [InvoiceController::class,'editDues'])->name('editDues');

});


Route::middleware([AuthMiddleware::class])->group(function () {

    Route::post('/user-verify-otp', [UserController::class, 'userVerifyOtp']);
    Route::post('/user-reset-password', [UserController::class, 'userResetPassword']);

});




