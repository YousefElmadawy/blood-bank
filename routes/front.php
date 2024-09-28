<?php

use App\Http\Controllers\Front\AuthController;

use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\GovernorateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('client')->middleware('guest')->group(function () {


    Route::get('/getRegister', [AuthController::class, 'getRegister'])->name('getRegister');
    Route::post('/register', [AuthController::class, 'register'])->name('client-register');

    Route::get('/getLogin', [AuthController::class, 'getLogin'])->name('getLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('client-login');

    Route::get('/getProfile', [AuthController::class, 'getProfile'])->name('getProfile');
    Route::post('/profile', [AuthController::class, 'editProfile'])->name('client-profile');

    Route::post('/logout', [AuthController::class, 'logout'])->name('client-logout');

    Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('client-getForget-password'); // page add phone .. //from sign in 
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('client-reset-password'); //actin to send mail
    //after add phone .. go to mail to get change password page
    //after add new password .. return to home view 
    Route::get('/change-password', [AuthController::class, 'GetChangePassword'])->name('client-getCahnge-password'); //page change password
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('client-change-password'); //action to change password
});

Route::get('/', [MainController::class, 'home'])->name('client-home');

Route::get('/donations', [MainController::class, 'allDonations'])->name('client-donations');


Route::get('/donations', [MainController::class, 'allDonations'])->name('client-donations');
Route::get('/get-donation', [MainController::class, 'getDonation'])->name('client-get-donation');
Route::post('/add-donation', [MainController::class, 'addDonation'])->name('client-add-donation');
Route::get('/donations/{donation}', [MainController::class, 'showOneDonation'])->name('client-donation');

Route::get('/posts', [MainController::class, 'allposts'])->name('client-posts');
Route::get('/about-us', [MainController::class, 'aboutUs'])->name('about-us');

Route::get('/contact-us', [MainController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-us', [MainController::class, 'addContact'])->name('addContact');

Route::post('/toggle-favorite', [MainController::class, 'toggleFavorite'])->name('client-favorite');
Route::get('/favorites', [MainController::class, 'allFavorites'])->name('client-get-favorite');
Route::get('/posts/{post}', [MainController::class, 'showOnePost'])->name('client-post');
Route::get('/governorates/{id}', [AuthController::class, 'getCities']);





    // Route::get('/page', [MainController::class, 'home'])->name('');




// Route::get('/about', [MainController::class, 'about'])->name('frontAbout');



// // Route::get('/cities/filter', [::class, 'filterCities']);
