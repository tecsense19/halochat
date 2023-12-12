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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Front\SubscriptionController;

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
        Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

        Route::get('/users', [UsersController::class, 'users'])->name('users');
        Route::post('/users/list', [UsersController::class, 'listUser'])->name('users.list');
        Route::get('users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('users/suspend/{id}', [UsersController::class, 'suspend'])->name('users.suspend');
        Route::get('users/active/{id}', [UsersController::class, 'active'])->name('users.active');

        Route::get('/users/credit_debit/{id}', [UsersController::class, 'usedCreditDebit'])->name('used_credit_debit');
        Route::post('/users/credit/debit/list', [UsersController::class, 'usedCreditDebitList'])->name('users.credit.debit.list');

        Route::get('/sale_report', [UsersController::class, 'sell_report'])->name('sale_report.sale');
        Route::get('/landerpage', [UsersController::class, 'landerpage'])->name('landerpage');
        Route::post('/addLanderpagedata/save', [UsersController::class, 'addLanderpagedata'])->name('addLanderpagedata');
        
        
        // ::Profiles
        Route::get('/add', [ProfileController::class, 'addProfiles'])->name('profile');
        Route::get('/list', [ProfileController::class, 'profiles'])->name('profile.list');
        Route::post('/profile/list', [ProfileController::class, 'profilesList'])->name('profile.lists');
        Route::get('profiles/destroy/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('profiles/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('profiles/store', [ProfileController::class, 'store'])->name('profile.store');
        Route::get('/globlepromptanime', [ProfileController::class, 'addGlobleprompts'])->name('profile.globleprompt');
        Route::get('/globlepromptreal', [ProfileController::class, 'addGloblepromptrealist'])->name('profile.globlepromptrealist');
        Route::post('profiles/storegloble', [ProfileController::class, 'store_globleprompts'])->name('profile.store_globleprompts');
        Route::post('profiles/delete', [ProfileController::class, 'deleteImage'])->name('profile.deleteImage');
    });

    // front routes

    Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
    Route::get('/explore', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/logout', [UserController::class, 'logout'])->name('front.logout');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::get('/chat', [UserController::class, 'chat'])->name('chat.chat');

    Route::get('/loadchat/{id}', [MessageController::class, 'loadchats'])->name('loadchats');
    Route::get('/mobile_loadchats/{id}', [MessageController::class, 'mobile_loadchats'])->name('mobile_loadchats');
  
    Route::get('/profile/setting', [UserController::class, 'profile'])->name('profile.profile');
    Route::post('/profile/update', [ProfilesController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfilesController::class, 'index'])->name('profile.index');
    Route::post('/profile/delete', [ProfilesController::class, 'delete'])->name('profile.delete');
    Route::get('/terms', [UserController::class, 'terms'])->name('terms.terms');
    Route::get('/privacy', [UserController::class, 'privacy'])->name('privacy.privacy');


    Route::get('/forgotpassword', [UserController::class, 'forgotpass'])->name('forgotpass');
    Route::post('/forgotpasswordcheck', [UserController::class, 'checkforgotpass'])->name('checkforgotpass');
    Route::get('/confirmpassword/{id}/{email}', [UserController::class, 'confirmpass'])->name('newpassword');
    Route::post('/checkconfirmpass', [UserController::class, 'checkconfirmpass'])->name('checkconfirmpass');
    

    Route::get('/chat/message/{id}', [MessageController::class, 'index'])->name('chat.message');
    Route::get('/chat/mobile/message/{id}', [MessageController::class, 'mobile'])->name('chat.messagemobile');
    // Route::post('/chat/message/store/{id}', [MessageController::class, 'store'])->name('chat.store');
    Route::post('/chat/message/userMessage', [MessageController::class, 'userMessage'])->name('chat.userMessage');
    Route::get('/chat/delete/{id}', [MessageController::class, 'delete'])->name('chat.delete');
    Route::get('/chat/liked/{id}', [MessageController::class, 'liked'])->name('chat.liked');
    Route::get('/chat/unliked/{id}', [MessageController::class, 'unliked'])->name('chat.unliked');

    Route::get('/gallery', [MessageController::class, 'gallery'])->name('gallery.gallery');
    Route::get('/gallary/delete/{id}', [MessageController::class, 'gallery_image_delete'])->name('gallery.delete');

    Route::post('/contact-us', [UserController::class, 'contact'])->name('contact');
    
    Route::get('auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
    Route::any('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

    Route::post('/payment', [PaymentController::class, 'showForm']);
    // Route::post('/payment', [PaymentController::class, 'makePayment']);
    Route::post('/orderplaced', [PaymentController::class, 'orderConfirm'])->name('payment.orderConfirm');

   

    //Plans Subscription
    Route::get('/subscriprion/plans', [SubscriptionController::class, 'index'])->name('subscription.index');

    Route::get('/chat/isdelete/{id}', [MessageController::class, 'Ischeckdeleted'])->name('chat.Ischeckdeleted');

    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
    
        return "Cache cleared successfully";
    });