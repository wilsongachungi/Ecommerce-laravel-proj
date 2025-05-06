<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminAuthController;

// Public welcome page
Route::get('/',[UserController::class,'index'])->name('user.home');
   


// Normal user dashboard
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Normal user profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
    Route::get('/products',[ProductController::class, 'index'])->name('admin.product.index');
    Route::post('/products/store',[ProductController::class, 'store'])->name('admin.product.store');
    Route::put('/products/update/{id}',[ProductController::class, 'update'])->name('admin.product.image.update');
    Route::delete('/products/image/{id}',[ProductController::class, 'deleteImage'])->name('admin.product.image.delete');
    Route::delete('/products/destroy/{id}',[ProductController::class, 'destroy'])->name('admin.product.image.destroy');
});

require __DIR__.'/auth.php';
