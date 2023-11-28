<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Managecredit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfilesController extends Controller
{
    public function index()
    {
        // Retrieve the user ID from the session
        $userId = session('user_id');
        if(session('user_id'))
        {
            // Use the user ID to fetch the user data
            $user = User::where('id', $userId)->first();
            $managecredit = Managecredit::where('user_id', $userId)->first();

            return view("front.profile.profile", compact('user','managecredit'));
        }
        else {
            return redirect()->route('login');
        }
       
    }

    public function update(request $request)
    {
       $input = $request->all();
       $userId = session('user_id');
       $user = User::where('id', $userId)->first();

            $user->name = $input['name']; 
            $user->email = $input['email']; 
            $user->gender = $input['gender']; 
            $user->save();
            // if($input['Newpassword']){
            //     $user->password = $input['Newpassword']; 
            // }
            if(isset($input['Newpassword']))
            {
                $request->validate([
                    'password' => 'required|min:8',
                    'Newpassword' => 'required|min:8'
                 ]);

                if ($user) {
                    if(Hash::check($input['password'], $user->password)){
                        $user->password = Hash::make($input['Newpassword']);
                        $user->save();
                    }else{
                        return redirect()->route("profile.index")->withError('Old password does not match');
                    }
                    // Update the password field with the new hashed password
                
                }
            }
            return redirect()->route('profile.index')->withSuccess('Profile updated successfully');
        }
        public function delete(request $request)
        {
            $input = $request->all();
            $userId = session('user_id');
            $user = User::where('id', $userId)->first();
            
            $user->deleted_at = date("Y-m-d H:i:s"); 
            $user->save();
            return view("front.profile.profile", compact('user'));
        }
}
