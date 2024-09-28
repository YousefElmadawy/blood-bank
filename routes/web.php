<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationRequestController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


 

Auth::routes();

Route::prefix('dashboard')->middleware('auth')->group(function() {
 
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('permissions', PermissionController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('addPermission');
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('givePermission');

 

    Route::resource('governorates' , GovernorateController::class);
    Route::resource('cities' , CityController::class);
    Route::resource('categories' , CategoryController::class);
    Route::resource('posts' , PostController::class);
    Route::resource('donations' , DonationRequestController::class);
    Route::resource('contact-us' , ContactController::class);
    Route::resource('settings' , SettingController::class);
    
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

require __DIR__. '/auth.php';
require __DIR__. '/front.php';



