<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeuzedeelController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SlbController;
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
    
    // Notification routes
    Route::get('/notificaties', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notificaties/{id}/markeer-gelezen', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notificaties/markeer-alle-gelezen', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notificaties/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notificaties', [NotificationController::class, 'destroyAll'])->name('notifications.destroy-all');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/students', [AdminController::class, 'students'])->name('students');
    
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
    Route::post('/keuzedelen/{keuzedeel}/annuleer', [AdminController::class, 'annuleerKeuzedeel'])->name('keuzedelen.annuleer');
});

// SLB routes
Route::middleware(['auth'])->prefix('slb')->name('slb.')->group(function () {
    Route::get('/dashboard', [SlbController::class, 'dashboard'])->name('dashboard');
    Route::get('/presentatie', [SlbController::class, 'presentatie'])->name('presentatie');
    Route::get('/presentatie/{keuzedeel}', [SlbController::class, 'keuzedeelSlide'])->name('keuzedeel-slide');
});
