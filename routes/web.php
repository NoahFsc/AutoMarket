<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OffersController;
use App\Http\Controllers\Admin\ReferencesController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes d'authentification
Route::name('auth.')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'doRegister']);
    Route::get('/register/step2', [AuthController::class, 'showRegisterStep2'])->name('register.step2');
    Route::post('/register/step2', [AuthController::class, 'doRegisterStep2']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes de réinitialisation de mot de passe
Route::prefix('password')->name('password.')->group(function () {
    Route::get('/reset', [AuthController::class, 'showLinkRequestForm'])->name('request');
    Route::post('/email', [AuthController::class, 'sendResetLinkEmail'])->name('email');
    Route::get('/reset/{token}', [AuthController::class, 'showResetForm'])->name('reset');
    Route::post('/reset', [AuthController::class, 'reset'])->name('update');
});

// Routes du catalogue
Route::get('/acheter', [CatalogController::class, 'acheter'])->name('catalog.acheter');
Route::get('/encherir', [CatalogController::class, 'encherir'])->name('catalog.encherir');
Route::get('/produit/{id}', [ProduitController::class, 'vente'])->name('produit.vente');
Route::get('/enchere/{id}', [ProduitController::class, 'enchere'])->name('produit.enchere');

// Nécessite d'être connecté pour accéder aux routes suivantes
Route::middleware('auth')->group(function () {

    // Routes de l'utilisateur
    Route::name('user.')->group(function () {
        Route::get('/profil', [UserController::class, 'index'])->name('index');
        Route::get('/profil/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/profil/edit', [UserController::class, 'update'])->name('update');
        Route::post('/profil/update-password', [UserController::class, 'updatePassword'])->name('updatePassword');
        Route::get('/profil/{id}', [UserController::class, 'index'])->name('show');
    });
});

// Nécessite d'être admin pour accéder aux routes suivantes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
    });

    Route::prefix('offers')->name('offers.')->group(function () {
        Route::get('/', [OffersController::class, 'index'])->name('index');
    });

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportsController::class, 'index'])->name('index');
    });

    Route::prefix('references')->name('references.')->group(function () {
        Route::get('/', [ReferencesController::class, 'index'])->name('index');
    });
});
