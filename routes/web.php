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
    Route::resource('categories', App\Http\Controllers\CategoryController::class);

    // Quizzes Routes
    Route::resource('quizzes', App\Http\Controllers\QuizController::class);

    // Questions Routes
    Route::resource('questions', App\Http\Controllers\QuestionController::class);

    // Users Routes
    Route::resource('users', App\Http\Controllers\UserController::class);

    // Results Routes
    Route::resource('results', App\Http\Controllers\ResultController::class);
});
