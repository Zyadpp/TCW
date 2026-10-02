<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\MastermindController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SettingsContentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* Every route in this file is an administrator-only route. Route names are
 * intentionally unchanged so existing Blade links keep working. */
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/programmes', [ProgrammeController::class, 'index'])->name('programmes.index');
    Route::post('/programmes', [ProgrammeController::class, 'store'])->name('programmes.store');
    Route::put('/programmes/{programme}', [ProgrammeController::class, 'update'])->name('programmes.update');
    Route::delete('/programmes/{programme}', [ProgrammeController::class, 'destroy'])->name('programmes.destroy');

    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::post('/inbox/{user}/messages', [InboxController::class, 'store'])->name('inbox.messages.store');
    Route::put('/inbox/{user}/messages/{message}', [InboxController::class, 'update'])->name('inbox.messages.update');
    Route::delete('/inbox/{user}/messages/{message}', [InboxController::class, 'destroy'])->name('inbox.messages.destroy');

    Route::get('/mastermind', [MastermindController::class, 'index'])->name('mastermind.index');
    Route::get('/mastermind/details/{group?}', [MastermindController::class, 'details'])->name('mastermind.details');
    Route::post('/mastermind/details/{group}/messages', [MastermindController::class, 'storeMessage'])->name('mastermind.messages.store');
    Route::put('/mastermind/details/{group}/messages/{message}', [MastermindController::class, 'updateMessage'])->name('mastermind.messages.update');
    Route::delete('/mastermind/details/{group}/messages/{message}', [MastermindController::class, 'destroyMessage'])->name('mastermind.messages.destroy');
    Route::post('/mastermind', [MastermindController::class, 'store'])->name('mastermind.store');
    Route::put('/mastermind/{group}', [MastermindController::class, 'update'])->name('mastermind.update');
    Route::put('/mastermind/{group}/members', [MastermindController::class, 'updateMembers'])->name('mastermind.members.update');
    Route::delete('/mastermind/{group}', [MastermindController::class, 'destroy'])->name('mastermind.destroy');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::get('/media/create', [MediaController::class, 'create'])->name('media.create');
    Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    Route::put('/media/{media}', [MediaController::class, 'update'])->name('media.update');
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/notification', [SettingController::class, 'notification'])->name('settings.notification');
    Route::put('/settings/notification', [SettingController::class, 'updateNotifications'])->name('settings.notification.update');
    Route::get('/settings/points-rewards', [SettingController::class, 'points'])->name('settings.points');
    Route::get('/settings/blogs', [SettingController::class, 'blogs'])->name('settings.blogs');
    Route::get('/settings/support-complaints', [SettingController::class, 'support'])->name('settings.support');
    Route::get('/settings/comments-management', [SettingController::class, 'comments'])->name('settings.comments');
    Route::get('/settings/chat-bot', [SettingController::class, 'chatbot'])->name('settings.chatbot');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::post('/settings/blogs', [SettingsContentController::class, 'storeBlog'])->name('settings.blogs.store');
    Route::put('/settings/blogs/{blog}', [SettingsContentController::class, 'updateBlog'])->name('settings.blogs.update');
    Route::delete('/settings/blogs/{blog}', [SettingsContentController::class, 'destroyBlog'])->name('settings.blogs.destroy');
    Route::post('/settings/actions', [SettingsContentController::class, 'storeAction'])->name('settings.actions.store');
    Route::put('/settings/actions/{pointAction}', [SettingsContentController::class, 'updateAction'])->name('settings.actions.update');
    Route::delete('/settings/actions/{pointAction}', [SettingsContentController::class, 'destroyAction'])->name('settings.actions.destroy');
    Route::put('/settings/support/{supportTicket}', [SettingsContentController::class, 'updateTicket'])->name('settings.support.update');
    Route::delete('/settings/comments/{contentComment}', [SettingsContentController::class, 'destroyComment'])->name('settings.comments.destroy');
    Route::delete('/settings/comments', [SettingsContentController::class, 'destroyComments'])->name('settings.comments.bulk-destroy');
    Route::post('/settings/chatbot/questions', [SettingsContentController::class, 'storeQuestion'])->name('settings.chatbot.questions.store');
    Route::put('/settings/chatbot/questions/{question}', [SettingsContentController::class, 'updateQuestion'])->name('settings.chatbot.questions.update');
    Route::delete('/settings/chatbot/questions/{question}', [SettingsContentController::class, 'destroyQuestion'])->name('settings.chatbot.questions.destroy');
    Route::post('/settings/chatbot/files', [SettingsContentController::class, 'uploadChatbotFile'])->name('settings.chatbot.files.store');
    Route::delete('/settings/chatbot/files/{file}', [SettingsContentController::class, 'destroyChatbotFile'])->name('settings.chatbot.files.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.status.update');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});
