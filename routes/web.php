<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\User\ProductListController;

// Public welcome page
Route::get('/', [UserController::class, 'index'])->name('user.home');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/services', [UserController::class, 'services'])->name('services');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// Normal user dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');



// Normal user profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //checkout
    Route::prefix('checkout')->controller(CheckoutController::class)->group(function () {
        Route::post('order', 'store')->name('checkout.store');
        Route::get('success', 'success')->name('checkout.success');
        Route::get('cancel', 'cancel')->name('checkout.cancel');
    });
});

// Admin guest routes (login form, login submit, logout)
Route::prefix('admin')->middleware('redirectAdmin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Admin dashboard (protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    //products routes
    Route::get('/products', [ProductController::class, 'index'])->name('admin.product.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('admin.product.image.update');
    Route::delete('/products/image/{id}', [ProductController::class, 'deleteImage'])->name('admin.product.image.delete');
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.product.image.destroy');

    //category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.category');

    //Brand
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::post('/brands/store', [BrandController::class, 'store'])->name('brands.store');
    Route::put('/brands/update/{id}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/destroy/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');

});

Route::prefix('cart')->controller(CartController::class)->group(function () {
    Route::get('view', 'view')->name('cart.view');
    Route::post('store/{product}', 'store')->name('cart.store');
    Route::patch('update/{product}', 'update')->name('cart.update');
    Route::delete('delete/{product}', 'delete')->name('cart.delete');
});

//list for product route and filter
Route::prefix('products')->controller(ProductListController::class)->group(function () {
    Route::get('/', 'index')->name('product.index');
});



require __DIR__ . '/auth.php';
