<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\FeedbackController;

Route::middleware('web')->group(function () {
    // Public routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware('auth')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        // Workshop routes
        Route::get('/workshop/register', [WorkshopController::class, 'index'])->name('workshop.list');
        Route::post('/workshop/{workshop}/register', [WorkshopController::class, 'register'])->name('workshop.register');
        Route::delete('/workshop/{workshop}/deregister', [WorkshopController::class, 'deregister'])->name('workshop.deregister');
        
        // Materials routes
        Route::get('/materials', [MaterialController::class, 'index'])->name('materials.list');
        Route::get('/material/{material}/download', [MaterialController::class, 'download'])->name('material.download');
        
        // Attendance routes
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.view');
        Route::post('/attendance/{workshop}', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
        
        // Certificate routes
        Route::get('/certificate', [CertificateController::class, 'index'])->name('certificate.view');
        Route::get('/workshop/certificate/{id}/download', [CertificateController::class, 'download'])->name('certificate.download');

        // Feedback routes
        Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
        Route::get('/feedback/{workshop}', [FeedbackController::class, 'show'])->name('feedback.show');
        Route::post('/feedback/{workshop}', [FeedbackController::class, 'store'])->name('feedback.store');
        Route::get('/feedback/{workshop}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
        Route::put('/feedback/{workshop}', [FeedbackController::class, 'update'])->name('feedback.update');
    });

    // Redirect root to login
    Route::get('/', function () {
        return redirect()->route('login');
    });
});
