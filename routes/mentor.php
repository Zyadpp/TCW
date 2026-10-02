<?php

use App\Http\Controllers\Mentor\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'mentor'])->prefix('mentor')->as('mentor.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
