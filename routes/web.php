<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdController;

Route::get('/', [AdController::class, 'index'])->name('home');
Route::get('/ads', [HomeController::class, 'ads'])->name('ads');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdController::class, 'dashboard'])->name('dashboard');
    Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
    Route::post('/ads', [AdController::class, 'store'])->name('ads.store');
});

Route::get('/ads/{ad}', [AdController::class, 'show'])->name('ads.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
