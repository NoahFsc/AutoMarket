<?php

use App\Http\Controllers\Admin\OffersController;
use App\Http\Controllers\Admin\ReferencesController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;

Route::get('/localization/{locale}', LocalizationController::class)->name('localization');

    Route::middleware('localization')->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');

        // Routes d'authentification
        Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
        Route::post('/register', [AuthController::class, 'doRegister']);
        Route::get('/register/complete', [AuthController::class, 'showRegisterStep2'])->name('auth.register.step2');
        Route::post('/register/complete', [AuthController::class, 'doRegisterStep2']);
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
        Route::get('/produit/{id}', [ProduitController::class, 'index'])->name('produit.index');
        
        // Nécessite d'être connecté pour accéder aux routes suivantes
        Route::middleware('auth')->group(function () {
        
            // Routes de l'utilisateur
            Route::prefix('profil')->group(function () {
                Route::get('/{id}', [UserController::class, 'index'])->name('user.index');
                Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
                Route::post('/{id}/edit', [UserController::class, 'update'])->name('user.update');
                Route::post('/{id}/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
            });
        
            // Routes de vente
            Route::prefix('vendre')->group(function () {
                Route::get('/', [VendreController::class, 'index'])->name('vendre.index');
                Route::get('/informations', [VendreController::class, 'showStep1'])->name('vendre.step1');
                Route::post('/informations', [VendreController::class, 'doStep1']);
                Route::get('/documents', [VendreController::class, 'showStep2'])->name('vendre.step2');
                Route::post('/documents', [VendreController::class, 'doStep2']);
                Route::get('/confirmation', [VendreController::class, 'showStep3'])->name('vendre.step3');
                Route::post('/confirmation', [VendreController::class, 'doStep3']);
                Route::post('/upload-media', [VendreController::class, 'uploadMedia'])->name('vendre.uploadMedia');
                Route::post('/upload-pdf', [VendreController::class, 'uploadPdf'])->name('vendre.uploadPDF');
                Route::get('/complete-sale/{offerId}', [VendreController::class, 'showCompleteSaleForm'])->name('vendre.complete-sale');
                Route::post('/complete-sale/{offerId}', [VendreController::class, 'completeSale']);
                Route::get('/historique-achats', [VendreController::class, 'showHA'])->name('user.historiqueachat');
                Route::get('/historique-achats/{orderId}', [VendreController::class, 'showhaview'])->name('user.ha-view');
                Route::post('/historique-achats/{orderId}/mark-received', [VendreController::class, 'markAsReceived'])->name('order.mark-received');
            });
        
            // Route de chat
            Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
            Route::get('/chat/start/{userId}', [ChatController::class, 'startConversation'])->name('chat.start');
        
        // Nécessite d'être admin pour accéder aux routes suivantes
        Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
        
            // Pages du panel admin
            Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
            Route::get('/users', [UsersController::class, 'index'])->name('admin.users-list');
            Route::get('/offers', [OffersController::class, 'index'])->name('admin.offers-list');
            Route::get('/reports', [ReportsController::class, 'index'])->name('admin.reports-list');
        
            // Liste des pages de références
            Route::prefix('references')->group(function () {
                Route::get('/brands', [ReferencesController::class, 'brands'])->name('admin.references.brands-list');
                Route::get('/models', [ReferencesController::class, 'models'])->name('admin.references.models-list');
                Route::get('/critair', [ReferencesController::class, 'critair'])->name('admin.references.critair-list');
                Route::get('/carburants', [ReferencesController::class, 'carburants'])->name('admin.references.carburants-list');
                Route::get('/portieres', [ReferencesController::class, 'portieres'])->name('admin.references.portieres-list');
                Route::get('/boites', [ReferencesController::class, 'boites'])->name('admin.references.boites-list');
                Route::get('/types', [ReferencesController::class, 'types'])->name('admin.references.types-list');
            });
        });    

    });

});