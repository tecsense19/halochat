<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Messages;
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
        if (session()->has('authenticated_user')) {
            $profileList = Profile::with('profileImages')->get();
            return view("front.dashboard", compact('profileList'));
        } else {
            $profileList = Profile::with('profileImages')->get();
            return view("front.dashboard", compact('profileList'));
        }
    }

    public function chat()
    {
        $user = Profile::with('profileImages')->first();
        $getLoginUser = User::where('id', session('user_id'))->first();
        $getall_Messages = Messages::where('sender_id', session('user_id'))->first();
        $getAllReciverUser = Messages::where('sender_id', session('user_id'))->get();
    
        $allReciver = [];
    
        foreach ($getAllReciverUser as $value) 
        {
            $user_profile = Profile::with('profileImages')->where('profile_id', $value->receiver_id)->first();
    
            if ($user_profile)
            { 
                // Create an associative array with both user_profile and value
                $combinedData = [
                    'message' => $value,
                    'user_profile' => $user_profile,
                ];
    
                // Add the combinedData to the $allReciver array
                $allReciver[] = $combinedData;
            }
        }
    
        
    
        if(empty($allReciver))
        {
            $profileList = Profile::with('profileImages')->get();
            return view("front.dashboard", compact('profileList'));
        }else{
            return view("front.chat.chat", compact("allReciver", "user" ,"getall_Messages"));
        }
        // Uncomment the lines below for debugging, then remove them when everything works
        // echo "<pre>";
        // print_r($allReciver);
        // die;
    }

    public function mobile()
    {
        $getLoginUser = User::where('id', session('user_id'))->first();
        $getAllReciverUser = Messages::where('sender_id', session('user_id'))->get();
    
        $allReciver = [];
    
        foreach ($getAllReciverUser as $value) 
        {
            $user_profile = Profile::with('profileImages')->where('profile_id', $value->receiver_id)->first();
    
            if ($user_profile)
            { 
                // Create an associative array with both user_profile and value
                $combinedData = [
                    'message' => $value,
                    'user_profile' => $user_profile,
                ];
    
                // Add the combinedData to the $allReciver array
                $allReciver[] = $combinedData;
            }
        }

        return view("front.chat.mobile", compact("allReciver"));
    }
    
    public function subscription()
    {
    return view("front.subscription.subscription");
    }

    public function terms()
    {
    return view("front.terms.terms");
    }
    
    public function profile()
    {
    return view("front.profile.profile");
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
            $request->session()->put('user_id', auth()->user()->id);
            $request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors(['email' => 'Your provided credentials do not match in our records.'])->onlyInput('email');

    } 
}