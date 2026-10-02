<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberContentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin interface
|--------------------------------------------------------------------------
| All admin routes live in their own file and use the /admin URL prefix.
*/
require __DIR__.'/admin.php';
require __DIR__.'/user.php';
require __DIR__.'/mentor.php';

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'loginPost'])->name('admin.login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::get('/verification', [AuthController::class, 'showVerificationRequest'])->name('verification.request');
Route::post('/verification', [AuthController::class, 'sendVerificationCode'])->name('verification.send');
Route::get('/verification/code', [AuthController::class, 'showOtpForm'])->name('verification.code');
Route::post('/verification/code', [AuthController::class, 'verifyOtp'])->name('verification.verify');
Route::post('/verification/resend', [AuthController::class, 'resendOtp'])->name('verification.resend');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetCode'])->name('password.email');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Website / member area
|--------------------------------------------------------------------------
*/
Route::get('/', [AuthController::class, 'home'])->name('landing');
Route::get('/home', [AuthController::class, 'home'])->name('home');
Route::view('/about-us', 'web.about')->name('about');
Route::view('/projects', 'web.projects')->name('projects');
Route::view('/services', 'web.services')->name('services');
Route::view('/programmes', 'web.programmes')->name('programmes');
Route::view('/stories', 'web.stories')->name('stories');
Route::view('/news', 'web.news')->name('news');
Route::view('/news/launch-of-our-first-training-courses', 'web.news-details')->name('news.details');
Route::view('/our-team', 'web.team')->name('team');
Route::view('/faq', 'web.faq')->name('faq');
Route::view('/contact-us', 'web.contact')->name('contact');
Route::view('/programmes/tcwtir', 'web.programme-details')->name('programmes.details');
Route::view('/checkout/tcwtir', 'web.checkout')->name('checkout');
Route::get('/account', [AuthController::class, 'account'])->middleware('auth')->name('account');
Route::post('/support-requests', [MemberContentController::class, 'storeTicket'])->middleware('auth')->name('support.store');
Route::post('/comments', [MemberContentController::class, 'storeComment'])->middleware('auth')->name('comments.store');
