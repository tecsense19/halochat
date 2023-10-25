<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class MessageController extends Controller
{
    public function index($id)
    {
        $user = Profile::with('profileImages')->where('profile_id',$id)->first();
        return view("front.chat.chat" ,compact("user"));
    }
}
