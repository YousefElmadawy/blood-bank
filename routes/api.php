<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
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

Route::group(['prefix' => 'v1'], function () {


    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('new-password', [AuthController::class, 'newPassworrd']);

    Route::middleware(['auth:sanctum'])->group(function () {


        Route::get('cities', [MainController::class, 'cities']);
        Route::get('governorates', [MainController::class, 'governorates']);

        Route::get('categories', [MainController::class, 'categories']);

        // Route::get('cities', [MainController::class, 'cities']);
        
        Route::get('settings', [MainController::class, 'settings']);
        Route::get('posts', [MainController::class, 'posts']);
        Route::get('posts/{post}', [MainController::class, 'post']);

        Route::post('favorite-post', [MainController::class, 'favoritePost']);
        Route::get('all-favorites', [MainController::class, 'allFavorites']);


        Route::post('profile', [AuthController::class, 'profile']);
        Route::post('contact', [MainController::class, 'contactUs']);

        Route::get('get-notifications', [MainController::class, 'getNotifications']);
        Route::post('set-notifications', [MainController::class, 'setNotifications']);

        Route::post('create-donation', [MainController::class, 'createDonationRequest']);
        Route::get('all-donations', [MainController::class, 'allDonations']);
    });
});
