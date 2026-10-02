<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\EventController;
use App\Http\Controllers\User\LearningController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'student'])->prefix('lms')->as('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events/{event}/alert', [EventController::class, 'toggleAlert'])->name('events.alert');
    Route::get('/events/{event}/live', [LearningController::class, 'liveEvent'])->name('events.live');
    Route::get('/lessons/{lesson}', [LearningController::class, 'lesson'])->name('lessons.show');
});
