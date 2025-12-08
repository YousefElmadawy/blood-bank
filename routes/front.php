<?php

use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\MainController;
use Illuminate\Support\Facades\Route;

// Guest routes (unauthenticated users)
Route::prefix('client')->middleware('guest:client-web')->group(function () {
    Route::get('/getRegister', [AuthController::class, 'getRegister'])->name('getRegister');
    Route::post('/register', [AuthController::class, 'register'])->name('client-register')->middleware('throttle:5,1');

    Route::get('/getLogin', [AuthController::class, 'getLogin'])->name('getLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('client-login')->middleware('throttle:5,1');

    Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('client-getForget-password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('client-reset-password')->middleware('throttle:3,1');

    Route::get('/change-password', [AuthController::class, 'GetChangePassword'])->name('client-getCahnge-password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('client-change-password')->middleware('throttle:3,1');
});

// Authenticated client routes
Route::prefix('client')->middleware('client.auth')->group(function () {
    Route::get('/getProfile', [AuthController::class, 'getProfile'])->name('getProfile');
    Route::post('/profile', [AuthController::class, 'editProfile'])->name('client-profile');

    Route::post('/logout', [AuthController::class, 'logout'])->name('client-logout');

    Route::get('/get-donation', [MainController::class, 'getDonation'])->name('client-get-donation');
    Route::post('/add-donation', [MainController::class, 'addDonation'])->name('client-add-donation');

    Route::post('/toggle-favorite', [MainController::class, 'toggleFavorite'])->name('client-favorite');
    Route::get('/favorites', [MainController::class, 'allFavorites'])->name('client-get-favorite');
});

// Public routes (accessible to everyone)
Route::get('/', [MainController::class, 'home'])->name('client-home');

Route::get('/donations', [MainController::class, 'allDonations'])->name('client-donations');
Route::get('/donations/{donation}', [MainController::class, 'showOneDonation'])->name('client-donation');

Route::get('/posts', [MainController::class, 'allposts'])->name('client-posts');
Route::get('/posts/{post}', [MainController::class, 'showOnePost'])->name('client-post');

Route::get('/about-us', [MainController::class, 'aboutUs'])->name('about-us');

Route::get('/contact-us', [MainController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-us', [MainController::class, 'addContact'])->name('addContact');

Route::get('/governorates/{id}', [AuthController::class, 'getCities']);
