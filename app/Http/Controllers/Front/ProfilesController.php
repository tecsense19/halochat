<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfilesController extends Controller
{
    public function index()
    {
        // Retrieve the user ID from the session
        $userId = session('user_id');
        // Use the user ID to fetch the user data
        $user = User::where('id', $userId)->first();

        return view("front.profile.profile", compact('user'));
    }

    public function update(request $request)
    {
       $input = $request->all();
       $userId = session('user_id');
       $user = User::where('id', $userId)->first();


        if($input['nickname']){
            // Replace 'New Name' with the new name you want
            $user->name = $input['nickname']; 
            // Save the changes to the database
            $user->save();
        }

        if($input['email']){
            // Replace 'New Name' with the new name you want
            $user->email = $input['email']; 
            // Save the changes to the database
            $user->save();
        }

        if($input['password']){
            // Replace 'New Name' with the new name you want
            $user->password = Hash::make($input['password']); 
            // Save the changes to the database
            $user->save();
        }
        return view("front.profile.profile", compact('user'));
    }
}
