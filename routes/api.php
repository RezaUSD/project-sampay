<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PetugasTaskController;

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

// Auth API Mobile
Route::post('/login', [AuthController::class, 'login']);

// Protected API Routes (Memerlukan Token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Petugas App Endpoints
    Route::prefix('petugas')->group(function () {
        Route::get('/tasks', [PetugasTaskController::class, 'getActiveTasks']);       // Daftar kerjaan
        Route::get('/tasks/{id}', [PetugasTaskController::class, 'showTask']);        // Detail kerjaan
        Route::post('/tasks/{id}/complete', [PetugasTaskController::class, 'completeTask']); // Upload bukti & selesai
        Route::get('/history', [PetugasTaskController::class, 'history']);            // Riwayat
    });
});
