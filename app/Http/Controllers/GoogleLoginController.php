<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
    
        return Socialite::driver('google')->redirect();
  
    }

    public function handleGoogleCallback()
    {
            $user = Socialite::driver('google')->user();
            if ($user) {
                // Add your code to save or authenticate the user here.
    
                if ($user) {
                    // Update the user with the same email if they exist, or create a new user
                    User::updateOrInsert(
                        ['email' => $user->email],
                        [
                            'name' => $user->name,
                            'google_id' => $user->id,
                            'password' => Hash::make($user->email),
                            'role' => 'User',
                            'plans' => 'Free',
                            'user_avatar' => $user->attributes['avatar'],
                            'email_verified' => $user->user['email_verified'],
                            'email_verified_at' => date('Y-m-d H:i:s')
                        ]
                    );
                } 
                return redirect()->route('front.dashboard'); // Adjust the route as needed
            }
        }
    
}
