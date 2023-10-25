<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function login()
    {
    return view("front.login");
    }

    public function logout()
    {
    Session::flush();
    $profileList = Profile::with('profileImages')->get();
    return view("front.dashboard", compact('profileList'));
    }

    public function register()
    {
    return view("front.register");
    }
    public function dashboard()
    {
        // if (session()->has('authenticated_user')) {
            $profileList = Profile::with('profileImages')->get();
            return view("front.dashboard", compact('profileList'));
        // } else {
            // The user is not authenticated. You can redirect them or take other actions.
        //     return redirect()->route('front.login'); // Redirect to the login page, for example.
        // }
    }
    

    public function chat()
    {
    return view("front.chat.chat");
    }

    public function subscription()
    {
    return view("front.subscription.subscription");
    }

    public function terms()
    {
    return view("front.terms.terms");
    }
    
    public function gallery()
    {
    return view("front.gallery.gallery");
    }
    
    public function store(Request $request)
    {
      
        $request->validate([
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8'
        ]);
    
        User::create([
            'email' => $request->email,
            'role' => 'User',
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')->withSuccess('You have successfully registered & logged in!');
    }

    public function authenticate(Request $request)
    {
        

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials) && auth()->user()->role === "User" && auth()->user()->deleted_at === null)
        {
            $request->session()->put('authenticated_user', true);
            $request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors(['email' => 'Your provided credentials do not match in our records.'])->onlyInput('email');

    } 
}