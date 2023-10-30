<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginRegisterController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Front\MessageController;
use App\Http\Controllers\Front\ProfilesController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\GoogleLoginController;
use Illuminate\Support\Facades\Artisan;
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


    Route::any('/', [UserController::class, 'dashboard'])->name('dashboard')->methods(['GET', 'POST', 'PUT', 'PATCH', 'DELETE']);
    // Route::get('/Users', [UsersController::class, 'Users'])->name('Users');
    Route::post('/admin/authenticate', [LoginRegisterController::class, 'authenticate'])->name('admin.authenticate');

    Route::group(['prefix' => '/admin', 'as' => 'admin.',], function () {
    Route::get('/', [LoginRegisterController::class, 'login'])->name('login');
    Route::get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
    Route::get('/users', [UsersController::class, 'users'])->name('users');
    

   // ::Profiles
    Route::get('/profiles', [ProfileController::class, 'addProfiles'])->name('profile');
    Route::get('profiles/list', [ProfileController::class, 'profiles'])->name('profile.list');
    Route::get('profiles/destroy/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('profiles/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profiles/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::post('profiles/delete', [ProfileController::class, 'deleteImage'])->name('profile.deleteImage');
});

    // front routes

    Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
    Route::get('/explore', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::get('/chat', [UserController::class, 'chat'])->name('chat.chat');
  
    
    Route::get('/subscription', [UserController::class, 'subscription'])->name('subscription.subscription');
    Route::get('/terms', [UserController::class, 'terms'])->name('terms.terms');
    Route::get('/profile/setting', [UserController::class, 'profile'])->name('profile.profile');
    Route::post('/profile', [ProfilesController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfilesController::class, 'index'])->name('profile.index');
    Route::post('/profile/delete', [ProfilesController::class, 'delete'])->name('profile.delete');

    Route::get('/chat/message/{id}', [MessageController::class, 'index'])->name('chat.message');
    Route::get('/chat/mobile/message/{id}', [MessageController::class, 'mobile'])->name('chat.messagemobile');
    Route::post('/chat/message/store/{id}', [MessageController::class, 'store'])->name('chat.store');
    Route::post('/chat/message/userMessage', [MessageController::class, 'userMessage'])->name('chat.userMessage');
    Route::get('/gallery', [MessageController::class, 'gallery'])->name('gallery.gallery');
    Route::get('/chat/delete/{id}', [MessageController::class, 'delete'])->name('chat.delete');
    


Route::get('auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::any('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');



Route::get('/clear-cache', function () {
	Artisan::call('cache:clear');
	Artisan::call('route:clear');
	Artisan::call('view:clear');
	Artisan::call('config:clear');
 
	return "Cache cleared successfully";
});