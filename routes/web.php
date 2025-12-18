<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeuzedeelController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/keuzedelen');
    }
    return redirect('/login');
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

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/enrollments', [AdminController::class, 'enrollments'])->name('enrollments');
    Route::get('/enrollments/{keuzedeel}', [AdminController::class, 'enrollmentsByKeuzedeel'])->name('enrollments.detail');
    Route::patch('/enrollments/{keuzedeel}/{user}', [AdminController::class, 'updateEnrollmentStatus'])->name('enrollments.update-status');
    Route::delete('/enrollments/{keuzedeel}/{user}', [AdminController::class, 'removeEnrollment'])->name('enrollments.remove');
    
    Route::get('/keuzedelen', [AdminController::class, 'keuzedeelIndex'])->name('keuzedelen.index');
    Route::get('/keuzedelen/create', [AdminController::class, 'keuzedeelCreate'])->name('keuzedelen.create');
    Route::post('/keuzedelen', [AdminController::class, 'keuzedeelStore'])->name('keuzedelen.store');
    Route::get('/keuzedelen/{keuzedeel}/edit', [AdminController::class, 'keuzedeelEdit'])->name('keuzedelen.edit');
    Route::put('/keuzedelen/{keuzedeel}', [AdminController::class, 'keuzedeelUpdate'])->name('keuzedelen.update');
    Route::delete('/keuzedelen/{keuzedeel}', [AdminController::class, 'keuzedeelDestroy'])->name('keuzedelen.destroy');
});
