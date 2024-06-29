<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products', ProductsController::class)->except('create', 'edit');

Route::controller(AuthController::class)->middleware('guest:sanctum')->group(function(){
    Route::post('/login', 'login');
});
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
