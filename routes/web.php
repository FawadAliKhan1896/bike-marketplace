<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdController;
use App\Http\Controllers\PublicDealershipController;
use App\Http\Controllers\PublicCalculatorController;

// Admin controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdminAdController;
use App\Http\Controllers\Admin\DealershipController as AdminDealershipController;
use App\Http\Controllers\Admin\CalculatorController as AdminCalculatorController;

Route::get('/', [AdController::class, 'index'])->name('home');
Route::get('/ads', [HomeController::class, 'ads'])->name('ads');

// Public Dealership and Calculator Routes
Route::get('/dealerships', [PublicDealershipController::class, 'index'])->name('dealerships');
Route::get('/price-calculator', [PublicCalculatorController::class, 'index'])->name('calculator');
Route::post('/price-calculator/calculate', [PublicCalculatorController::class, 'calculate'])->name('calculator.calculate');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdController::class, 'dashboard'])->name('dashboard');
    Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
    Route::post('/ads', [AdController::class, 'store'])->name('ads.store');
});

Route::get('/ads/{ad}', [AdController::class, 'show'])->name('ads.show');

// Admin Routes (Authenticated & Admin role required)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Ads Management
    Route::get('/ads', [AdminAdController::class, 'index'])->name('ads.index');
    Route::post('/ads/{ad}/toggle-status', [AdminAdController::class, 'toggleStatus'])->name('ads.toggle-status');
    Route::get('/ads/{ad}/edit', [AdminAdController::class, 'edit'])->name('ads.edit');
    Route::put('/ads/{ad}', [AdminAdController::class, 'update'])->name('ads.update');
    Route::delete('/ads/{ad}', [AdminAdController::class, 'destroy'])->name('ads.destroy');

    // Dealerships CRUD
    Route::resource('dealerships', AdminDealershipController::class)->except(['show']);

    // Calculator Rules & Valuations Logs
    Route::get('/calculator/valuations', [AdminCalculatorController::class, 'valuations'])->name('calculator.valuations');
    Route::resource('calculator', AdminCalculatorController::class)->parameters(['calculator' => 'calculator'])->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
