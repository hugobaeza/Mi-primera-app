<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Mostrar el formulario de registro
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

// Mostrar el formulario de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard protegido
Route::middleware('auth:webusers')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/publication/{id}/edit', [DashboardController::class, 'edit'])->name('publication.edit');
    Route::put('/publication/{id}', [DashboardController::class, 'update'])->name('publication.update');
    Route::delete('/publication/{id}', [DashboardController::class, 'destroy'])->name('publication.destroy');
});

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});
