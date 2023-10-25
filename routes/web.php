<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginRegisterController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Front\MessageController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/projects/halochat', function () {
    return redirect('/front');
});

Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
// Route::get('/Users', [UsersController::class, 'Users'])->name('Users');


Route::group(['prefix' => '/admin', 'as' => 'admin.',], function () {

    Route::get('/', [LoginRegisterController::class, 'login'])->name('login');
    Route::get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
    Route::get('/users', [UsersController::class, 'Users'])->name('users');

   // ::Profiles
    Route::get('/profiles', [ProfileController::class, 'addProfiles'])->name('profile');
    Route::get('profiles/list', [ProfileController::class, 'profiles'])->name('profile.list');
    Route::get('profiles/destroy/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('profiles/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profiles/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::post('profiles/delete', [ProfileController::class, 'deleteImage'])->name('profile.deleteImage');
});

// Route::any('/', [UserController::class, 'dashboard'])->name('dashboard');

Route::group(['prefix' => '/front', 'as' => 'front.',], function () {
    Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
    Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::get('/chat', [UserController::class, 'chat'])->name('chat.chat');
    Route::get('/chat/message/{id}', [MessageController::class, 'index'])->name('chat.message');
    Route::get('/subscription', [UserController::class, 'subscription'])->name('subscription.subscription');
});


Route::get('auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::any('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');



Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');

    return 'Cache has been cleared'; // You can also return a view here if you prefer.
});

Route::get('/clear-route-cache', function () {
    $exitCode = Artisan::call('route:clear');

    return 'Route cache has been cleared'; // You can customize the response as needed.
});