<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Managecredit;
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

                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => env('AI_CHATUSER_URL').'/users',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>'{
                            "user_name": "'.$user->email.'"
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


                        $result = User::updateOrInsert(
                            ['email' => $user->email],
                            [
                                'name' => $user->name,
                                'google_id' => $user->id,
                                'chatuser_id' => $chatuser_id,
                                'role' => 'User',
                                'plans' => 'Free',
                                'user_avatar' => $user->attributes['avatar'],
                                'email_verified' => $user->user['email_verified'],
                                'email_verified_at' => now(),
                                'created_at'=> now(),
                            ]
                        );

                        $userId = User::where('email', $user->email)->first();
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
                    }

                    if($user->deleted_at == null) 
                    {
                        // Update the user with the same email if they exist, or create a new user
                        $userId = User::where('email', $user->email)->first();
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