<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Messages;
use App\Models\Managecredit;
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
        Messages::whereNull('user_id')
        ->whereNull('sender_id')
        ->delete();
        
        if (session('user_id')) {
            $getAllReciverUser = Messages::where('user_id', session('user_id'))->limit(1)->get();
            if(empty($getAllReciverUser[0]['receiver_id']))
            {
                $profileList = Profile::with('profileImages')->get();
                return view("front.dashboard", compact('profileList'));
            }else{
                $user = Profile::with('profileImages')->where('profile_id',$getAllReciverUser[0]['receiver_id'])->first();
                $getAllProfile = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)
                                ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                                ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                                ->groupBy('messages.profile_id')
                                ->get();
                    return view("front.chat.chat", compact("getAllProfile", "user", "getAllReciverUser"));
            }
        }else{
         
            $profileList = Profile::with('profileImages')->get();
            return view("front.dashboard", compact('profileList'));
        }
        
    }

    public function mobile()
    {
        if (session()->has('authenticated_user')) {
            $getAllProfile = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)
                            ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                            ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                            ->groupBy('messages.profile_id')
                            ->get();
       
            return view("front.chat.mobile", compact("getAllProfile"));
        }else{
            Messages::whereNull('profile_id')
            ->whereNull('user_id')
            ->whereNull('sender_id')
            ->whereNull('receiver_id')
            ->delete();
        $profileList = Profile::with('profileImages')->get();
        return view("front.dashboard", compact('profileList'));
        }
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
    
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://159.89.22.38:8080/users',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "user_name": "'.$request->email.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic '.env('AI_CHATUSER_APIKEY')
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        $responseArray = json_decode($response, true);

        // Check if the decoding was successful and if the 'id' key exists
        if (is_array($responseArray) && array_key_exists('data', $responseArray) && array_key_exists('id', $responseArray['data'])) {
            // Access the 'id' value and store it in a PHP variable
            $chatuser_id = $responseArray['data']['id'];  
        } else {
            // Handle the case where 'id' is not found in the response
            echo "The 'id' key was not found in the JSON response.";
        }

        User::create([
            'email' => $request->email,
            'role' => 'User',
            'chatuser_id' => $chatuser_id,
            'password' => Hash::make($request->password)
        ]);

        $userId = User::where('email', $request->email)->first();
        $request->session()->put('user_id', $userId->id);
        $creditAdd = Managecredit::updateOrInsert(
            ['user_id' => $userId->id],
            [
                'user_id' => $userId->id,
                'currentcredit' => 200,
                'usedcredit' => 0,
                'totalcredit' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

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