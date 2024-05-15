<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->name('dashboard.')->prefix('dashboard')->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/categories/trash', [CategoriesController::class, 'trash'])
    ->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategoriesController::class, 'restore'])
    ->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
    ->name('categories.force-delete');
    
    Route::resource('/categories', CategoriesController::class);
});

