<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Profile;
use App\Models\Messages;
use App\Models\Managecredit;
use App\Models\Usedcredites;
use App\Models\Passwordresets;
use App\Models\Feedback;
use App\Mail\Resetpasslink;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function login()
    {
    return view("front.login");
    }

    public function logout(Request $request)
    {
        // Auth::logout();
        $request->session()->forget('authenticated_user');
        $request->session()->forget('user_id');
        $request->session()->forget('sessionprofile_id');
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        $profileList = Profile::with('profileImages')->get();
        return view("front.dashboard", compact('profileList'));
    }

    public function register()
    {
        return view("front.register");
    }
    public function dashboard(Request $request)
    {
        if (session()->has('authenticated_user')) {
            $profileList = Profile::with('profileImages')->get();
            $request->session()->put('sessionprofile_id', $profileList[0]->profile_id);

            $userischecked = User::where('id', session('user_id'))->where('deletechat_flag',1)->first();
            if(isset($userischecked))
            {
                if($userischecked->deletechat_flag == 1)
                {
                    Messages::where('profile_id', $profileList[0]->profile_id)->where('sequence_message','!=',0)->update(['isDeleted' => 1]);
                }else{
                    Messages::where('sender_id',$profileList[0]->profile_id)->where('receiver_id', session('user_id'))->where('isDeleted', 0)->orderBy('sequence_message', 'DESC')->update(['isDeleted' => 1]);
                }
            }

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

    public function terms()
    {
    return view("front.terms.terms");
    }
    public function privacy()
    {
    return view("front.privacy.privacy");
    }
    
    public function profile()
    {
    return view("front.profile.profile");
    }
    
    public function gallery()
    {
    return view("front.gallery.gallery");
    }

    public function forgotpass(Request $request)
    {
         return view("front.forgotpass");
    }

    public function checkforgotpass(Request $request)
    {
        if($request->all() != null) {
            $input = $request->all();
            $userexit = User::where('email', $input['email'])->first(); // Replace $userId with the actual user's ID
            if(!$userexit)
            {
                return back()->withErrors(['emailNot' => 'Email not register with us'])->withInput();  
            }else{
                Passwordresets::updateOrInsert(
                    ['token' => $input['_token']],
                    ['email' => $input['email']],
                    ['created_at' => now()]
                    
                );
            
                // Mail::to('john@example.com')->send(new Resetpasslink($data));
                Mail::to($input['email'])->send(new Resetpasslink($input['_token'], $input['email']));
                // Mail::send('mail/sendlink', ['user' => $input], function ($m) use ($input) {
                //     $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                //     $m->to( $input['email'] )->subject('Forgot Password');
                // });

            }
            return back()->with(['success' => 'Reset password link sent to your email address.'])->withInput();
            }
    }

    public function confirmpass(Request $request, $token, $email)
    {
        // Mail::to('gautam@tec-sense.com')->send(new Resetpasslink($input['_token'], $input['email']));
        return view("front.newpassword");
    }

    public function checkconfirmpass(Request $request)
    {
        $input = $request->all();
        $uPasswordresetsser = Passwordresets::where('token', $input['_token'])->first();
        if($uPasswordresetsser->flag == 1) {
            return redirect()->route('login')->withSuccess('Link hasbeen expired!');
        }else{
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8'
        ]);

      
        $checktoken = Passwordresets::where('token', $input['_token'])->first();

        if($checktoken->token = $input['_token'])
        {
            $user = User::where('email', $checktoken->email)->first(); // Replace $userId with the actual user's ID

            if ($user) {
                if($input['password'] === $input['confirm_password']){
                    $user->password = Hash::make($input['confirm_password']);
                    $user->save();  

                    Passwordresets::updateOrInsert(
                        ['token' => $input['_token']],
                        ['flag' => 1]
                    );
                }else{
                    return view("front.newpassword")->withErrors(['wrong' => 'Confirm password not matched'])->withInput('wrong');  
                }
                // Update the password field with the new hashed password
               
            }
        }
    }
        return redirect()->route('login')->withSuccess('Password has been reset successfully');
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
            "user_name": "'.$request->name.'"
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
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'User',
            'chatuser_id' => $chatuser_id,
            'password' => Hash::make($request->password)
        ]);

        $userId = User::where('email', $request->email)->first();
        $request->session()->put('user_id', $userId->id);

        Managecredit::updateOrInsert(
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

       Usedcredites::updateOrInsert(
            ['user_id' => $userId->id],
            [
                'user_id' => $userId->id,
                'credit' => 200,
                'credit_debit_date' => now(),
                'payment_id' => 1111,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->put('authenticated_user', true);
        $request->session()->put('user_id', auth()->user()->id);
        // $request->session()->regenerate();   
        
        return redirect()->route('dashboard')->withSuccess('You have successfully registered & logged in!');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
     
        $userId = User::where('email', $request->email)->first();
        if(!empty($userId->deleted_at))
        {
            return back()->withErrors(['deleted' => 'Your account has been deleted please contact admin!'])->onlyInput('deleted');
        }
        else
        {
        if(Auth::attempt($credentials) && auth()->user()->role === "User")
            {
                if( auth()->user()->status === "Suspend"){
                    return back()->withErrors(['deleted' => 'Your account has been suspended'])->onlyInput('email');
                }
                $request->session()->put('authenticated_user', true);
                $request->session()->put('user_id', auth()->user()->id);
                // $request->session()->regenerate();

                //check last profile id
                $profileList = Profile::with('profileImages')->get();
                $request->session()->put('sessionprofile_id', $profileList[0]->profile_id);

                $lastchatid = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)->orderBy('sequence_message', 'DESC')->first();
                if(isset($lastchatid->profile_id))
                {
                    return redirect()->route('chat.message',['id' => $lastchatid->profile_id])->withSuccess('You have successfully registered & logged in!'); 
                }else{
                    return redirect()->route('dashboard')->withSuccess('You have successfully logged in!');
                }
                // return redirect()->route('dashboard')->withSuccess('You have successfully logged in!');
            }
            else{
            return back()->withErrors(['email' => 'Your provided credentials do not match in our records.'])->onlyInput('email');
        }
     }
        
    } 

    public function contact(Request $request)
    {
        $input = $request->all();
        Feedback::updateOrInsert(
            ['user_id' => isset($input['user_id']) ? $input['user_id'] : '',
            'name' => isset($input['name']) ? $input['name'] : '' , 
            'email' => isset($input['email']) ? $input['email'] : '', 
            'message' => isset($input['message']) ? $input['message'] : '']
        );        
        return true;
    }
}