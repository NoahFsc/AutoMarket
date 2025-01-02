<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendreController;
use App\Http\Controllers\ProduitController;
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

Route::get('/vendre', [VendreController::class, 'index'])->name('vendre.index');

Route::get('/vendre/step1', [VendreController::class, 'showStep1'])->name('vendre.step1');
Route::post('/vendre/step1', [VendreController::class, 'doStep1'])->name('vendre.step1');
Route::get('/vendre/step2', [VendreController::class, 'showStep2'])->name('vendre.step2');
Route::post('/vendre/step2', [VendreController::class, 'doStep2'])->name('vendre.step2');
Route::get('/vendre/step3', [VendreController::class, 'showStep3'])->name('vendre.step3');
Route::post('/vendre/step3', [VendreController::class, 'doStep3'])->name('vendre.step3');
Route::post('/vendre/upload-media', [VendreController::class, 'uploadMedia'])->name('vendre.uploadMedia');


Route::get('/vendre', [VendreController::class, 'index'])->name('vendre.index');

Route::get('/vendre/step1', [VendreController::class, 'showStep1'])->name('vendre.step1');
Route::post('/vendre/step1', [VendreController::class, 'doStep1'])->name('vendre.step1');
Route::get('/vendre/step2', [VendreController::class, 'showStep2'])->name('vendre.step2');
Route::post('/vendre/step2', [VendreController::class, 'doStep2'])->name('vendre.step2');
Route::get('/vendre/step3', [VendreController::class, 'showStep3'])->name('vendre.step3');
Route::post('/vendre/step3', [VendreController::class, 'doStep3'])->name('vendre.step3');
Route::post('/vendre/upload-media', [VendreController::class, 'uploadMedia'])->name('vendre.uploadMedia');


Route::get('/acheter', [CatalogController::class, 'acheter'])->name('catalog.acheter');
Route::get('/encherir', [CatalogController::class, 'encherir'])->name('catalog.encherir');
Route::get('/produit/{id}', [ProduitController::class, 'vente'])->name('produit.vente');
Route::get('/enchere/{id}', [ProduitController::class, 'enchere'])->name('produit.enchere');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [UserController::class, 'index'])->name('user.index');
    Route::get('/profil/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/profil/edit', [UserController::class, 'update'])->name('user.update');
    Route::post('/profil/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
    Route::get('/profil/{id}', [UserController::class, 'index'])->name('user.show');
});
