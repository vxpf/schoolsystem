<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeuzedeelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profiel', [ProfileController::class, 'show'])->name('profile.show');
    
    // Keuzedelen routes
    Route::get('/keuzedelen', [KeuzedeelController::class, 'index'])->name('keuzedelen.index');
    Route::get('/keuzedelen/mijn', [KeuzedeelController::class, 'mijnKeuzedelen'])->name('keuzedelen.mijn');
    Route::get('/keuzedelen/{keuzedeel}', [KeuzedeelController::class, 'show'])->name('keuzedelen.show');
    Route::post('/keuzedelen/{keuzedeel}/aanmelden', [KeuzedeelController::class, 'aanmelden'])->name('keuzedelen.aanmelden');
    Route::post('/keuzedelen/{keuzedeel}/afmelden', [KeuzedeelController::class, 'afmelden'])->name('keuzedelen.afmelden');
});
