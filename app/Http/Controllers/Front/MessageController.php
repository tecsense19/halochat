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
    public function userMessage(Request $request){
        
        $user = Profile::with('profileImages')->where('profile_id',$_POST['receiver_id'])->first();
        if (session()->has('authenticated_user')) {
            $userId = User::where('id', $_POST['sender_id'])->first();

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

            $getAllReciverUser = [];
            $user = '';
            $getAllProfile =[];
            if(session('user_id')){
                $getAllReciverUser = Messages::where('profile_id',$_POST['receiver_id'])->get();
                $user = Profile::with('profileImages')->where('profile_id',$_POST['receiver_id'])->first();
                $getAllProfile = Messages::where('sender_id', session('user_id'))
                                            ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                                            ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                                            ->groupBy('messages.profile_id')
                                            ->get();
            }

            $this->callAPI($userId->chatuser_id, $_POST['message'], $user->profile_id, $userId);
            return redirect()->back();
        }else{
            
            return redirect()->route('login');
        }
           
    }

    public function callAPI($id, $message, $profile_id, $userId)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => env('AI_CHATUSER_URL').'/'.'users/'.$id.'/chat',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "user_message": "'.$message.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic '.env('AI_CHATUSER_APIKEY')
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $responseArray = json_decode($response, true);
        if (isset($responseArray['data']['ai_message'])) {
            $ai_message = $responseArray['data']['ai_message'];
        } else {
            echo "ai_message not found in the response.";
            die;
        }

        $messageAi = array(
            'profile_id'=> $profile_id,
            'user_id'=> session('user_id'),
            'sender_id'=> session('user_id'),
            'receiver_id'=>  $profile_id,
            'status'=> 'Active',
            'message_text'=> $ai_message,
            'updated_at' => now(),
        );
        Messages::create($messageAi);

    
        if($userId)
        {   
            $creditAddManage = Managecredit::where('user_id', $userId->id)->first();
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
    }
    public function index($id)
    {
        $user = Profile::with('profileImages')->where('profile_id',$id)->first();
        $MessageData = Messages::where('sender_id', session('user_id'))->where('receiver_id', $user->profile_id)->first();

        if(!$MessageData){
            // echo "hi";
            // die;
            if(session('user_id'))
            {
                $message = array(
                    'profile_id'=> $user->profile_id,
                    'user_id'=> session('user_id'),
                    'sender_id'=> session('user_id'),
                    'receiver_id'=>  $user->profile_id,
                    'status'=> 'Active',
                    'message_text'=> $user->first_message,
                    'updated_at' => now(),
                );
            }else{
                $message = array(
                    'status'=> 'Active',
                    'message_text'=> $user->first_message,
                    'updated_at' => now(),
                );
            }
           
            Messages::create($message); 
            $getAllReciverUser = Messages::where('profile_id',$id)->limit(1)->get();
            $user = Profile::with('profileImages')->where('profile_id',$id)->first();

            $getAllProfile = Messages::where('sender_id', session('user_id'))->where('receiver_id',$id)->where('isDeleted', 0)
                                        ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                                        ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                                        ->groupBy('messages.profile_id')
                                        ->get();
                                        return view("front.chat.chat", compact("getAllProfile", "getAllReciverUser", "user"));
            
        }else{
            $getAllReciverUser = [];
            $user = '';
            $getAllProfile =[];
            if(session('user_id')){
                $getAllReciverUser = Messages::where('profile_id',$id)->where('isDeleted', 0)->get();
                $user = Profile::with('profileImages')->where('profile_id',$id)->first();
                $getAllProfile = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)
                                            ->join('profiles', 'profiles.profile_id', '=', 'messages.profile_id')
                                            ->join('profile_images', 'profile_images.profile_id', '=', 'messages.profile_id')
                                            ->whereNotNull('profiles.profile_id')
                                            ->groupBy('messages.profile_id')
                                            ->get();
            
                                           
            }else{
                $getAllReciverUser = Messages::where('profile_id',$id)->where('isDeleted', 0)->limit(1)->get();
                $user = Profile::with('profileImages')->where('profile_id',$id)->first();

                $getAllProfile = Messages::where('sender_id', session('user_id'))->where('receiver_id',$id)->where('isDeleted', 0)
                                            ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                                            ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                                            ->groupBy('messages.profile_id')
                                            ->get();
                                         
            }
            return view("front.chat.chat", compact("getAllProfile", "getAllReciverUser", "user"));
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

            $getAllReciverUser = [];
            $user = '';
            $getAllProfile =[];
            if(session('user_id')){
                $getAllReciverUser = Messages::where('profile_id',$id)->where('isDeleted', 0)->get();
                $user = Profile::with('profileImages')->where('profile_id',$id)->first();
                $getAllProfile = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)
                                            ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                                            ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                                            ->groupBy('messages.profile_id')
                                            ->get();
            }
            return view("front.chat.mobile", compact("getAllProfile", "getAllReciverUser", "user"));

        }else{
            $getAllReciverUser = [];
            $user = '';
            $getAllProfile =[];
            if(session('user_id')){
                $getAllProfile = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)
                                            ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                                            ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                                            ->groupBy('messages.profile_id')
                                            ->get();
            } 
            $getAllReciverUser = Messages::where('profile_id',$id)->where('isDeleted', 0)->get();
            $user = Profile::with('profileImages')->where('profile_id',$id)->first();
            return view("front.chat.mobile", compact("getAllProfile", "getAllReciverUser", "user"));
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
        Messages::where('profile_id', $id)->update(['isDeleted' => 1]);
        return redirect()->back();
    }
}