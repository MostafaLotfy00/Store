<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'type:admin,super-admin'])->name('dashboard.')->prefix('dashboard')->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/categories/trash', [CategoriesController::class, 'trash'])
    ->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategoriesController::class, 'restore'])
    ->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
    ->name('categories.force-delete');
    
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products', ProductsController::class);
});

