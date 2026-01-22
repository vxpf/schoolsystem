<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\KeuzedeelCrudController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeuzedeelStudentController;
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
    
    // Keuzedelen routes (student)
    Route::get('/keuzedelen', [KeuzedeelStudentController::class, 'index'])->name('keuzedelen.index');
    Route::get('/keuzedelen/mijn', [KeuzedeelStudentController::class, 'mijnKeuzedelen'])->name('keuzedelen.mijn');
    Route::get('/keuzedelen/{keuzedeel}', [KeuzedeelStudentController::class, 'show'])->name('keuzedelen.show');
    Route::post('/keuzedelen/{keuzedeel}/aanmelden', [KeuzedeelStudentController::class, 'aanmelden'])->name('keuzedelen.aanmelden');
    Route::post('/keuzedelen/{keuzedeel}/afmelden', [KeuzedeelStudentController::class, 'afmelden'])->name('keuzedelen.afmelden');
    
    // Inbox routes
    Route::get('/inbox', [NotificationController::class, 'index'])->name('inbox.index');
    Route::post('/inbox/{id}/markeer-gelezen', [NotificationController::class, 'markAsRead'])->name('inbox.mark-read');
    Route::post('/inbox/markeer-alle-gelezen', [NotificationController::class, 'markAllAsRead'])->name('inbox.mark-all-read');
    Route::delete('/inbox/{id}', [NotificationController::class, 'destroy'])->name('inbox.destroy');
    Route::delete('/inbox', [NotificationController::class, 'destroyAll'])->name('inbox.destroy-all');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/students', [AdminController::class, 'students'])->name('students');
    
    Route::get('/enrollments', [AdminController::class, 'enrollments'])->name('enrollments');
    Route::get('/enrollments/{keuzedeel}', [AdminController::class, 'enrollmentsByKeuzedeel'])->name('enrollments.detail');
    Route::patch('/enrollments/{keuzedeel}/{user}', [AdminController::class, 'updateEnrollmentStatus'])->name('enrollments.update-status');
    Route::delete('/enrollments/{keuzedeel}/{user}', [AdminController::class, 'removeEnrollment'])->name('enrollments.remove');
    
    // Keuzedelen CRUD (resource controller)
    Route::resource('keuzedelen', KeuzedeelCrudController::class)->except(['show']);
    Route::post('/keuzedelen/{keuzedeel}/annuleer', [KeuzedeelCrudController::class, 'annuleer'])->name('keuzedelen.annuleer');
});

// SLB routes
Route::middleware(['auth'])->prefix('slb')->name('slb.')->group(function () {
    Route::get('/dashboard', [SlbController::class, 'dashboard'])->name('dashboard');
    Route::get('/presentatie', [SlbController::class, 'presentatie'])->name('presentatie');
    Route::get('/presentatie/{keuzedeel}', [SlbController::class, 'keuzedeelSlide'])->name('keuzedeel-slide');
    Route::get('/cijfers', [SlbController::class, 'cijfers'])->name('cijfers');
    Route::patch('/cijfer/{keuzedeel}/{user}', [SlbController::class, 'updateCijfer'])->name('update-cijfer');
    Route::get('/cijfers/student', [SlbController::class, 'studentCijfers'])->name('student-cijfers');
});
