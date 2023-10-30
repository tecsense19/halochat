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

    public function handleGoogleCallback(Request $request)
    {
            $user = Socialite::driver('google')->user();
            if ($user) {
                // Add your code to save or authenticate the user here.
                    // Get the user ID by querying the database based on the email
                    $userId = User::where('email', $user->email)->first();
                    
                    if($userId)
                    {
                        echo "ok";
                    }else{
                        $result = User::updateOrInsert(
                            ['email' => $user->email],
                            [
                                'name' => $user->name,
                                'google_id' => $user->id,
                                'role' => 'User',
                                'plans' => 'Free',
                                'user_avatar' => $user->attributes['avatar'],
                                'email_verified' => $user->user['email_verified'],
                                'email_verified_at' => now(),
                                'created_at'=> now(),
                            ]
                        );
                    }

                    if($userId->deleted_at == null) 
                    {
                         // Update the user with the same email if they exist, or create a new user
                        $request->session()->put('authenticated_user', true);
                        $request->session()->put('user_id', $userId->id);
                        $request->session()->regenerate();
                        return redirect()->route('dashboard')->withSuccess('You have successfully logged in!');
                    }
                    else {
                    return redirect()->route('login')->withErrors(['email' => 'Your account has been deleted please contact admin!'])->onlyInput('email');
                    }

              }else{
                return back()->withErrors(['email' => 'Your provided credentials do not match in our records.'])->onlyInput('email');
              }
        }
    }