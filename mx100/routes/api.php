<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

// Endpoint Terbuka
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Endpoint Tertutup (Butuh Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Endpoint Jobs
    Route::get('/jobs', [JobController::class, 'index']);
    Route::post('/jobs', [JobController::class, 'store']);
    
    // --- TAMBAHKAN BARIS INI ---
    Route::get('/jobs/{id}/applications', [JobController::class, 'showApplications']);
    
    // Endpoint Applications (Fitur Apply)
    Route::post('/jobs/{id}/apply', [ApplicationController::class, 'apply']);
});