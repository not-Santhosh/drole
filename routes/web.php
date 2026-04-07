<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function() {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'authRegister'])->name('register.validate');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authLogin'])->name('login.validate');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('dashboard');

    Route::prefix('students')->name('students.')->group(function() {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::get('/export', [StudentController::class, 'export'])->name('export');
        Route::post('/import', [StudentController::class, 'import'])->name('import');
    });

    Route::prefix('staff')->name('staff.')->group(function() {
        Route::get('/', [StaffController::class, 'index'])->name('index');
        Route::post('/store', [StaffController::class, 'store'])->name('store');
        Route::get('/export', [StaffController::class, 'export'])->name('export');
        Route::post('/import', [StaffController::class, 'import'])->name('import');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/get-programmes/{department_id}', [StudentController::class, 'getProgrammes'])->name('getProgrammes');
});