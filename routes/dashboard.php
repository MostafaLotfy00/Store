<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->name('dashboard.')->prefix('dashboard')->group(function(){

    Route::get('/', [DashboardController::class, 'index']);
    
    Route::resource('/categories', CategoriesController::class);
});

