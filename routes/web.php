<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'doRegister'])->name('auth.register');

Route::get('/register/step2', [AuthController::class, 'showRegisterStep2'])->name('auth.register.step2');
Route::post('/register/step2', [AuthController::class, 'doRegisterStep2'])->name('auth.register.step2');

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'doLogin']);

Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [UserController::class, 'index'])->name('user.index');
    Route::get('/profil/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/profil/edit', [UserController::class, 'update'])->name('user.update');
    Route::post('/profil/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
});
