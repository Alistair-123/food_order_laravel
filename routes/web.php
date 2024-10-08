<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [FoodController::class, 'index'])->name('home');

// Cart Routes
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Admin Routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/add-food', [AdminController::class, 'addFood'])->name('admin.addFood');
Route::get('/admin/delete-food/{id}', [AdminController::class, 'deleteFood'])->name('admin.deleteFood');
Route::get('/admin/purchases', [AdminController::class, 'viewPurchases'])->name('admin.purchases');

Route::get('/admin/edit-food/{id}', [AdminController::class, 'editFood'])->name('admin.editFood');
Route::post('/admin/update-food/{id}', [AdminController::class, 'updateFood'])->name('admin.updateFood');

