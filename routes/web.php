<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth:staff'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Categories Routes
    Route::get('dashboard/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('dashboard.categories.index');
    Route::get('dashboard/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::post('dashboard/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('dashboard.categories.store');
    Route::get('dashboard/categories/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('dashboard.categories.show');
    Route::get('dashboard/categories/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('dashboard.categories.edit');
    Route::put('dashboard/categories/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('dashboard.categories.update');
    Route::delete('dashboard/categories/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');
});
