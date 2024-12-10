<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// News routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [NewsController::class, 'index'])->name('dashboard');
    // Store a new news post
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');

    // Update an existing news post
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');

    // Delete a news post
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
