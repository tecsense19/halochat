<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Messages;
use App\Models\Profile;
use App\Models\Managecredit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class MessageController extends Controller
{
    public function userMessage(){
    
        $user = Profile::with('profileImages')->where('profile_id',$_POST['receiver_id'])->first();
        if (session()->has('authenticated_user')) {
            $message = array(
                'profile_id'=> $user->profile_id,
                'user_id'=> session('user_id'),
                'sender_id'=> $user->profile_id,
                'receiver_id'=>  session('user_id'),
                'status'=> 'Active',
                'message_text'=> $_POST['message'],
                'updated_at' => now(),
            );
            Messages::create($message);

            $userId = User::where('id', $_POST['sender_id'])->first();
            if($userId)
            {   
                $creditAddManage = Managecredit::where('user_id', $userId->id)->first();
                // print_r($creditAddManage);
                // die;
                 $creditAdd = Managecredit::updateOrInsert(
                ['user_id' => $userId->id],
                [
                    'currentcredit' => $creditAddManage->currentcredit - 1,
                    'usedcredit' => $creditAddManage->usedcredit + 1,
                    'totalcredit' => $creditAddManage->totalcredit - 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            }
    
            $getLoginUser = User::where('id', session('user_id'))->first();
            $getall_Messages = Messages::where('sender_id', session('user_id'))->where('receiver_id', $_POST['receiver_id'])->first();
            $getall_UserMessages = Messages::where('sender_id', $_POST['receiver_id'])->where('receiver_id', session('user_id'))->get();
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
            return redirect()->back();
        }else{
            
            return redirect()->route('login');
        }
        
    }
    public function index($id)
    {
        $user = Profile::with('profileImages')->where('profile_id',$id)->first();
        $MessageData = Messages::where('sender_id', session('user_id'))->where('receiver_id',$user->profile_id)->first();

    
        if(!$MessageData){
            $message = array(
                'profile_id'=> $user->profile_id,
                'user_id'=> session('user_id'),
                'sender_id'=> session('user_id'),
                'receiver_id'=>  $user->profile_id,
                'status'=> 'Active',
                'message_text'=> 'Hey there… have we met before?',
                'updated_at' => now(),
            );
            Messages::create($message);

            $getLoginUser = User::where('id', session('user_id'))->first();
            $getall_Messages = Messages::where('sender_id', session('user_id'))->where('receiver_id', $id)->first();
            $getall_UserMessages = Messages::where('sender_id', $id)->where('receiver_id', session('user_id'))->get();
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
        
            return view("front.chat.chat", compact("allReciver", "user" ,"getall_Messages", "getall_UserMessages"));

        }else{
            $getLoginUser = User::where('id', session('user_id'))->first();
            $getall_Messages = Messages::where('sender_id', session('user_id'))->where('receiver_id', $id)->first();
            $getall_UserMessages = Messages::where('sender_id', $id)->where('receiver_id', session('user_id'))->get();
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
        
        
            return view("front.chat.chat", compact("allReciver", "user" ,"getall_Messages", "getall_UserMessages"));
        }
        
    }

    public function mobile($id)
    {
        $user = Profile::with('profileImages')->where('profile_id',$id)->first();
        $MessageData = Messages::where('sender_id', session('user_id'))->where('receiver_id',$user->profile_id)->first();
        
        if(!$MessageData){
            $message = array(
                'profile_id'=> $user->profile_id,
                'user_id'=> session('user_id'),
                'sender_id'=> session('user_id'),
                'receiver_id'=>  $user->profile_id,
                'status'=> 'Active',
                'message_text'=> 'Hey there… have we met before?',
                'updated_at' => now(),
            );
            Messages::create($message);

            $getLoginUser = User::where('id', session('user_id'))->first();
            $getall_Messages = Messages::where('sender_id', session('user_id'))->where('receiver_id', $id)->first();
            $getall_UserMessages = Messages::where('sender_id', $id)->where('receiver_id', session('user_id'))->get();
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
        
            return view("front.chat.mobile", compact("allReciver", "user" ,"getall_Messages", "getall_UserMessages"));

        }else{
            $getLoginUser = User::where('id', session('user_id'))->first();
            $getall_Messages = Messages::where('sender_id', session('user_id'))->where('receiver_id', $id)->first();
            $getall_UserMessages = Messages::where('sender_id', $id)->where('receiver_id', session('user_id'))->get();
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
        
            return view("front.chat.mobile", compact("allReciver", "user" ,"getall_Messages","getall_UserMessages"));
        }
        
    }

    public function gallery(Request $request)
    {
        $id = session('user_id');
        $getall_Picture = Messages::select('*')
        ->where('sender_id', session('user_id'))
        ->whereNotNull('media_url')
        ->get();
    
        $all_UserProfile = [];
        foreach ($getall_Picture as $key => $value) {

            $user = Profile::with('profileImages')->where('profile_id',$value->profile_id)->first();
            $value->profile = $user;

            $count = Messages::where('user_id', session('user_id'))->where('profile_id',$value->profile_id)
            ->whereNotNull('media_url')
            ->count();
            $value->count = $count;

            $all_UserProfile[] = $value;
        }

      return view("front.gallery.gallery", compact("all_UserProfile"));

    }

    public function delete($id)
    {

        Messages::where('sender_id', session('user_id'))
        ->delete();

        return redirect()->back();
    }
}
