<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
/**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        // $request->session()->regenerate();
        return redirect()->route('dashboard')->withSuccess('You have successfully registered & logged in!');
    }

    public function dashboard()
    {
        if(Auth::check() && session()->has('authenticated_admin'))
        {
            return view('admin.dashboard');
        }
        
        return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
    } 

    public function authenticate(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials) && auth()->user()->role === "Admin")
        {
            // $request->session()->regenerate();
            $request->session()->put('authenticated_admin', true);
            return redirect()->route('admin.dashboard')->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors(['email' => 'Your provided credentials do not match in our records.'])->onlyInput('email');

    } 
    public function logout(Request $request)
    {
        $request->session()->forget('authenticated_admin');
        // Perform other logout actions
        // Auth::logout(); 
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('admin.login')->withSuccess('You have logged out successfully!');;
    } 
}