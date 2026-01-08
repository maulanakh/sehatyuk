<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;

// Landing Page
Route::get('/', function () {
    if (session()->has('user')) {
        return redirect('/home');
    }
    return redirect('/login');
});

// ------------------------
// Auth
// ------------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------------
// Halaman setelah login (hanya untuk user yang sudah login)
Route::middleware(['session.auth'])->group(function () {

    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Chatbot
    Route::get('/chatbot', [ChatController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/ask', [ChatController::class, 'ask'])->name('chatbot.ask');


    // BMI Kalkulasi
    Route::get('/bmi', [HomeController::class, 'bmi'])->name('bmi');

    // Berita & Tips
    Route::get('/berita', [BeritaController::class, 'index']);


    //Admin Dashboard
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::post('/admin/tips/add', [AdminController::class, 'addTip'])->name('admin.tips.add');

        Route::get('/admin/tips/{id}', [AdminController::class, 'showTip'])->name('admin.tips.show');
        Route::get('/admin/tips/{id}/edit', [AdminController::class, 'editTip'])->name('admin.tips.edit');
        Route::put('/admin/tips/{id}', [AdminController::class, 'updateTip'])->name('admin.tips.update');
        Route::delete('/admin/tips/{id}', [AdminController::class, 'deleteTip'])->name('admin.tips.delete');
    });
});
