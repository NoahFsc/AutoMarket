<?php

use App\Http\Controllers\Admin\OffersController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ReferencesController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes d'authentification
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'doRegister']);
Route::get('/register/step2', [AuthController::class, 'showRegisterStep2'])->name('auth.register.step2');
Route::post('/register/step2', [AuthController::class, 'doRegisterStep2']);
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Routes de réinitialisation de mot de passe
Route::prefix('password')->group(function () {
    Route::get('/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset', [AuthController::class, 'reset'])->name('password.update');
});

// Routes du catalogue
Route::get('/acheter', [CatalogController::class, 'acheter'])->name('catalog.acheter');
Route::get('/encherir', [CatalogController::class, 'encherir'])->name('catalog.encherir');
Route::get('/produit/{id}', [ProduitController::class, 'vente'])->name('produit.vente');
Route::get('/enchere/{id}', [ProduitController::class, 'enchere'])->name('produit.enchere');

// Nécessite d'être connecté pour accéder aux routes suivantes
Route::middleware('auth')->group(function () {

    // Routes de l'utilisateur
    Route::prefix('profil')->group(function () {
        Route::get('/{id}', [UserController::class, 'index'])->name('user.index');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/{id}/edit', [UserController::class, 'update'])->name('user.update');
        Route::post('/{id}/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
    });
});

// Nécessite d'être admin pour accéder aux routes suivantes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Pages du panel admin
    Route::get('/users', [UsersController::class, 'index'])->name('admin.users-list');
    Route::get('/offers', [OffersController::class, 'index'])->name('admin.offers-list');
    Route::get('/reports', [ReportsController::class, 'index'])->name('admin.reports-list');

    // Liste des pages de références
    Route::prefix('references')->group(function () {
        Route::get('/brands', [ReferencesController::class, 'brands'])->name('admin.references.brands-list');
        Route::get('/models', [ReferencesController::class, 'models'])->name('admin.references.models-list');
        Route::get('/critair', [ReferencesController::class, 'critair'])->name('admin.references.critair-list');
    });
});
