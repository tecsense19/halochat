<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Messages;
use App\Models\Profile;
use App\Models\Managecredit;
use App\Models\Globle_prompts;
use App\Models\Subscriptions;
use App\Models\Chatapi_responses;
use App\Models\Usedcredites;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;



class MessageController extends Controller
{
    public function loadchats(Request $request)
    {
        $getAllReciverUser = Messages::where('user_id',session('user_id'))->where('profile_id', $_GET['id'])->where('isDeleted', 0)->orderBy('guid', 'asc')->get();
        return view("front.chat.bind", compact('getAllReciverUser'));

    } 

    public function mobile_loadchats(Request $request)
    {
        $getAllReciverUser = Messages::where('user_id',session('user_id'))->where('profile_id', $_GET['id'])->where('isDeleted', 0)->orderBy('guid', 'asc')->get();
        return view("front.chat.mobile_bind", compact('getAllReciverUser'));

    } 

    public function userMessage(Request $request)
    {
        $user = Profile::with('profileImages')->where('profile_id',$_POST['receiver_id'])->first();
        $message_show = $_POST['message']; // Assuming you're getting the message from a form input
        $message_url = "";
        $getAllReciverUser = [];
        $globleprompts = Globle_prompts::where('type' , $user->personatype)->first();
        // Explode the words and phrases and trim each element
        $getAllReciverUser = Messages::where('user_id',session('user_id'))->where('profile_id', $_POST['receiver_id'])->where('isDeleted', 0)->get();

        if(!empty($globleprompts->wordsphrases)){
            $words = array_map('trim', explode(',', $globleprompts->wordsphrases));
            foreach ($words as $word) {
                // Use a regular expression with word boundaries to match whole words
                $pattern = "/\b" . preg_quote($word, '/') . "\b/";
                // Check if the pattern is present in the message
                while (preg_match($pattern, $message_show)) {
                        // Remove the matched word from $message_show
                        $message_show = preg_replace($pattern, '', $message_show, 1);
                    }
                }
           }
       
            if(empty($user->profile_id)){
                return back()->withErrors(['chat_persona' => 'Please select persona'])->withInput();  
            }

        if (session()->has('authenticated_user')) {
            $userId = User::where('id', $_POST['sender_id'])->first();

            $getMessageSequnce = Messages::where('sender_id', $user->profile_id)->where('receiver_id', session('user_id'))->orderBy('guid', 'desc')->where('isDeleted', 0)->first();
    
            $message = array(
                'profile_id'=> $user->profile_id,
                'user_id'=> session('user_id'),
                'sender_id'=> $user->profile_id,
                'receiver_id'=>  session('user_id'),
                'status'=> 'Active',
                'message_text'=> trim($message_show),
                'updated_at' => now(),
                'guid' => $getMessageSequnce ? ($getMessageSequnce->guid + 1) : 0,
                'sequence_message' => $getMessageSequnce ? ($getMessageSequnce->guid + 1) : 0,
            );
            Messages::create($message);

            
            $user = '';
            $getAllProfile =[];
            if(session('user_id')){
                // $getAllReciverUser = Messages::where('profile_id',$_POST['receiver_id'])->get();
                
                $user = Profile::with('profileImages')->where('profile_id',$_POST['receiver_id'])->first();
                $getAllProfile = Messages::where('sender_id', session('user_id'))
                                            ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                                            ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                                            ->groupBy('messages.profile_id')
                                            ->get();
            }
            $creditAddManage = Managecredit::where('user_id', session('user_id'))->first();
        
            if($creditAddManage->currentcredit <= 0){
                return "credit over";
            }else{  
                // Now $message_show contains the original string with all matched words removed
                if (str_contains($message_show, 'show')) {
                    if($creditAddManage->currentcredit >= 2)
                    {
                        // $subscriptionsUser = Subscriptions::where('user_id', session('user_id'))->first();
                        // if(!empty($subscriptionsUser)){
                            $message_url = $this->checkStringForWord($message_show,$user->persona_id,$user->prompt,$globleprompts->globle_realistic_nagative_prompt,$globleprompts->globle_realistic_prompts,$globleprompts->globle_anime_prompts,$globleprompts->globle_realistic_terms,$globleprompts->globle_anime_terms,$globleprompts->restore_faces,$globleprompts->seed,$globleprompts->denoising_strength,$globleprompts->enable_hr,$globleprompts->hr_scale,$globleprompts->hr_upscaler,$globleprompts->sampler_index,$globleprompts->email,$globleprompts->steps,$globleprompts->cfg_scale,$user->profile_id,$user->first_message,$user->image_prompt,$user->nagative_prompt);    
                        // }
                    }
                }
                sleep(1);
 
                $this->callAPI($userId->chatuser_id, $message_show, $user->profile_id, $userId, $message_url,$user->first_message,$_POST['receiver_id'],$getMessageSequnce ? ($getMessageSequnce->guid + 1) : 0);
            }
            return view("front.chat.bind", compact('getAllReciverUser'));
            // return true;
        }else{
            
            return redirect()->route('login');
        }
           
    }

    public function callAPI($id, $message, $profile_id, $userId, $message_url, $first_message, $receiver_id, $sequnce_number)
    {
        $creditAddManage = Managecredit::where('user_id', $userId->id)->first();
        $getFirstMessage = Profile::where('profile_id', $profile_id)->first();
        if($creditAddManage->currentcredit == 0){
            return "<script>alert('Your trail credit is over');</script>";
        }else{
            if(!empty($message_url)){
               
                $getMessageSequnce = Messages::where('receiver_id', $profile_id)->where('sender_id', $userId->id)->where('isDeleted', 0)->where('message_text', '!=', $getFirstMessage->first_message)->orderBy('guid', 'desc')->first();
                Messages::updateOrInsert(
                    ['image_id' => $message_url['image_id']],
                    [
                        'profile_id'=> $profile_id,
                        'user_id'=> session('user_id'),
                        'sender_id'=> session('user_id'),
                        'receiver_id'=>  $profile_id,
                        'status'=> 'Active',
                        'media_url' => $message_url['image_url'],
                        'image_id' => $message_url['image_id'],
                        'sequence_message' => $getMessageSequnce ? ($getMessageSequnce->guid + 1) : 0,
                    ]
                );

                Managecredit::updateOrInsert(
                    ['user_id' => $userId->id],
                    [
                        'currentcredit' => $creditAddManage->currentcredit - 2,
                        'usedcredit' => $creditAddManage->usedcredit + 2,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );

                Usedcredites::Insert(
                    [
                        'user_id' => $userId->id,
                        'debit' => 2,
                        'credit_debit_date' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }else{

                $postfeild = '{
                            "user_message": "'.str_replace(["\n", "\r", '"'], '', $message).'",
                            "persona_id": "'.$getFirstMessage->persona_id.'",
                            "max_completion_tokens": '.$getFirstMessage->max_prompt_length.',
                            "max_prompt_words": '.$getFirstMessage->max_ai_reply_length.',
                            "request_id": "'.$sequnce_number.'",
                            "persona": {
                            "name": "'.$getFirstMessage->name.'",
                            "system_prompt": "'.str_replace(["\n", "\r", '"'], '', $getFirstMessage->system_prompt).'",
                            "system_instruction": "'.str_replace(["\n", "\r", '"'], '', $getFirstMessage->system_instruction).'",
                            "voice_name": "'.$getFirstMessage->voice_name.'",
                            "voice_model": "'.$getFirstMessage->voice_model.'",
                            "voice_settings": {
                                "stability": '.$getFirstMessage->stability.',
                                "similarity_boost": '.$getFirstMessage->similarity_boost.',
                                "style": '.$getFirstMessage->style.',
                                "use_speaker_boost": '.$getFirstMessage->use_speaker_boost.'
                            },
                            "short_description": "'.$getFirstMessage->short_description.'",
                            "first_message": "'.$getFirstMessage->first_message.'"
                            }
                        }';

                $maxRetries = 3; // Set the maximum number of retries
                $retryDelay = 1; // Set the delay between retries in seconds

                for ($retry = 0; $retry < $maxRetries; $retry++) {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => env('AI_CHATUSER_URL').'/'.'users/'.$id.'/chat',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 25,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $postfeild,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Basic '.env('AI_CHATUSER_APIKEY')
                    ),
                    ));
                        $response = curl_exec($curl);
                        if (curl_errno($curl)) {
                            $curlError = curl_error($curl);
                            // Check if the error is a timeout
                            if (strpos($curlError, 'Operation timed out') !== false) {
                                //echo "Timeout occurred. Retrying...\n";
                                sleep($retryDelay); // Add a delay before retrying
                                continue; // Retry the loop
                            } else {
                                echo 'Curl error: ' . $curlError;
                                break; // Exit the loop if it's not a timeout
                            }
                        }
                        // Create a timestamp
                        $timestamp = date('Y-m-d H:i:s');
                        // Combine the timestamp and the response array
                        $dataToWrite = "Timestamp: $timestamp\n\nText request: ". print_r($postfeild, true) ." \nText API Response: ". print_r($response, true) ."";
                        // Define the file path
                        $filePath = 'Text-API-Response.txt';
                        // Open the file in append mode, or create it if it doesn't exist
                        $file = fopen($filePath, 'a');
                        // Write the data to the file
                        fwrite($file, $dataToWrite);
                        // Close the file
                        fclose($file);
                        // store response
                        $responseObject = json_decode($response);
                        // $chatjson = array(
                        //     'user_id'=> session('user_id'),
                        //     'json'=> 'message'.$response,
                        //     'message'=> isset($responseObject->data->ai_message) ? $responseObject->data->ai_message : '',
                        // );
                        // Chatapi_responses::create($chatjson);
                        if (isset($responseObject->data->ai_message)) {
                            $this->creditcut($profile_id,$responseObject->data->ai_message,$responseObject->data->request_id,$userId,$creditAddManage);
                            curl_close($curl);    
                        } else {
                            return back()->withErrors(['ai_message' => 'Message not found in the response'])->withInput();
                        }
                            // Process $response as needed
                        //echo "Request successful!\n";
                        break; // Exit the loop on successful request
                    }
                    
                    
                }
            }
        }

    public function creditcut($profile_id,$responseObjectAi_message,$responseObjectRequest_id,$userId,$creditAddManage)
    {
        $creditAddManage = Managecredit::where('user_id', $userId->id)->first();
        $getFirstMessage = Profile::where('profile_id', $profile_id)->first();
        $getMessageSequnce = Messages::where('sender_id', session('user_id'))
                ->where('receiver_id', $profile_id)
                ->where('isDeleted', 0)
                ->where('message_text', '!=', $getFirstMessage->first_message)
                ->orderBy('guid', 'desc')
                ->first();

        $messageAi = array(
            'profile_id'=> $profile_id,
            'user_id'=> session('user_id'),
            'sender_id'=> session('user_id'),
            'receiver_id'=>  $profile_id,
            'status'=> 'Active',
            'message_text'=> nl2br($responseObjectAi_message),
            'guid' => $responseObjectRequest_id,
            'updated_at' => now(),
            'sequence_message' => $responseObjectRequest_id,
        );
        Messages::create($messageAi);

        Managecredit::updateOrInsert(
            ['user_id' => $userId->id],
            [
                'currentcredit' => $creditAddManage->currentcredit - 1,
                'usedcredit' => $creditAddManage->usedcredit + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        Usedcredites::Insert(
            [
                'user_id' => $userId->id,
                'debit' => 1,
                'credit_debit_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function index(Request $request, $id)
    {
        Messages::whereNull('user_id')
        ->whereNull('sender_id')
        ->delete();

        $user = Profile::with('profileImages')->where('profile_id',$id)->first();
        if($user)
        {
            $MessageData = Messages::where('sender_id', session('user_id'))->where('receiver_id', $user->profile_id)->where('isDeleted' , 0)->first();

            if(!$MessageData){

                if(session('user_id'))
                {
                    User::where('id', session('user_id'))->update(['deletechat_flag' => 0]);
                    $message = array(
                        'profile_id'=> $user->profile_id,
                        'user_id'=> session('user_id'),
                        'sender_id'=> session('user_id'),
                        'receiver_id'=>  $user->profile_id,
                        'status'=> 'Active',
                        'message_text'=> $user->first_message,
                        'sequence_message'=> 0,
                        'guid'=> 0,
                        'updated_at' => now(),
                    );
                }else{
                    $message = array(
                        'profile_id'=> $user->profile_id,
                        'user_id'=> session('user_id'),
                        'sender_id'=> session('user_id'),
                        'receiver_id'=>  $user->profile_id,
                        'status'=> 'Active',
                        'message_text'=> $user->first_message,
                        'guid'=> 0,
                        'sequence_message'=> 0,
                        'updated_at' => now(),
                    );
                }

                Messages::create($message); 
                $getAllReciverUser = Messages::where('profile_id',$id)->where('isDeleted', 0)->limit(1)->get();
                $user = Profile::with('profileImages')->where('profile_id',$id)->first();
                $getAllProfile = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)
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

                    $getAllReciverUser = Messages::where('user_id',session('user_id'))->where('profile_id', $id)->where('isDeleted', 0)->get();
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
                    $getAllProfile = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)
                                                ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                                                ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                                                ->groupBy('messages.profile_id')
                                                ->get();

                                            
                                            
                }
                return view("front.chat.chat", compact("getAllProfile", "getAllReciverUser", "user"));
            }
        }
        else
        {
            return redirect()->back();
        }        
    }

    public function mobile($id)
    {
        Messages::whereNull('user_id')
        ->whereNull('sender_id')
        ->delete();

        $user = Profile::with('profileImages')->where('profile_id',$id)->first();
        $MessageData = Messages::where('sender_id', session('user_id'))->where('receiver_id', $user->profile_id)->where('isDeleted' , 0)->first();

        if(!$MessageData){

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
                    'profile_id'=> $user->profile_id,
                    'user_id'=> session('user_id'),
                    'sender_id'=> session('user_id'),
                    'receiver_id'=>  $user->profile_id,
                    'status'=> 'Active',
                    'message_text'=> $user->first_message,
                    'updated_at' => now(),
                );
            }

            Messages::create($message); 
            $getAllReciverUser = Messages::where('profile_id',$id)->where('isDeleted', 0)->limit(1)->get();
            $user = Profile::with('profileImages')->where('profile_id',$id)->first();
            $getAllProfile = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)
                                        ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                                        ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                                        ->groupBy('messages.profile_id')
                                        ->get();
                                        return view("front.chat.mobile", compact("getAllProfile", "getAllReciverUser", "user"));
            
        }else{
            $getAllReciverUser = [];
            $user = '';
            $getAllProfile =[];
            if(session('user_id')){

                $getAllReciverUser = Messages::where('user_id',session('user_id'))->where('profile_id', $id)->where('isDeleted', 0)->get();
                $user = Profile::with('profileImages')->where('profile_id',$id)->first();
                $getAllProfile = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)
                                            ->join('profiles', 'profiles.profile_id', '=', 'messages.profile_id')
                                            ->join('profile_images', 'profile_images.profile_id', '=', 'messages.profile_id')
                                            ->whereNotNull('profiles.profile_id')
                                            ->groupBy('messages.profile_id')
                                            ->get();
                                        // echo "<pre>";
                                        //     print_r($getAllReciverUser);
                                        //     die;
            
                                           
            }else{
                
                $getAllReciverUser = Messages::where('profile_id',$id)->where('isDeleted', 0)->limit(1)->get();
                $user = Profile::with('profileImages')->where('profile_id',$id)->first();
                $getAllProfile = Messages::where('sender_id', session('user_id'))->where('isDeleted', 0)
                                            ->join('profiles', 'profiles.profile_id','=','messages.profile_id')
                                            ->join('profile_images', 'profile_images.profile_id','=','messages.profile_id')
                                            ->groupBy('messages.profile_id')
                                            ->get();

                                        
                                         
            }
            return view("front.chat.mobile", compact("getAllProfile", "getAllReciverUser", "user"));
        }
    }

    public function gallery(Request $request)
    {
        $id = session('user_id');

        $responseArr = [];
                
        $getConnectedUser = Messages::with('reciverProfile')->where('sender_id', $id)->groupBy('receiver_id')->get();
        $totalCount = 0;
        foreach ($getConnectedUser as $key => $value) 
        {
            $newObj = new \StdClass();    
            $newObj->name = count($value->reciverProfile) > 0 ? $value->reciverProfile[0]->name : '';
            $newObj->image_count = Messages::where('sender_id', $id)->where('receiver_id', $value->receiver_id)->where('isDeleted', 0)->where('media_url', '!=' , "")->count();
            $newObj->images = Messages::where('sender_id', $id)->where('receiver_id', $value->receiver_id)->where('isDeleted', 0)->where('media_url', '!=' , "")->get();
            if($newObj->image_count > 0)
            {
                $responseArr[] = $newObj;
            }
            $totalCount = $totalCount > 0 ? $totalCount + $newObj->image_count : $newObj->image_count;
        }
        

        return view("front.gallery.gallery", compact("responseArr", "totalCount"));

    }

    public function gallery_image_delete($id)
    {
        Messages::where('message_id', $id)->update(['media_url' => null]);
        return true;
    }

    // public function delete($id)
    // {

    //     Messages::where('profile_id', $id)->update(['isDeleted' => 1]);
    //     $user = User::where('id', session('user_id'))->first();
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //     CURLOPT_URL => env('AI_CHATUSER_URL').'/users'.'/'.$user->chatuser_id.'/chat',
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => '',
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => 'DELETE',
    //     CURLOPT_HTTPHEADER => array(
    //         'Authorization: Basic '.env('AI_CHATUSER_APIKEY')
    //     ),
    //     ));
    //     $fetchfirst = Messages::where('user_id',session('user_id'))->where('isDeleted', 0)->get();

    //     $profile = Messages::where('user_id',session('user_id'))->where('isDeleted', 0)->first();

    //     $profile_id = isset($profile->profile_id) ? $profile->profile_id : '';
    //     // Get the count of records
    //       $count = $fetchfirst->count();
    //       if($count < 0){
    //         return 1;
    //       }
    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     return response()->json(['data' => $profile_id]);
    // }

    public function delete($id)
    {
        
        Messages::where('profile_id', $id)->update(['isDeleted' => 1]);
        User::where('id', session('user_id'))->update(['deletechat_flag' => 1]);
        $user = User::where('id', session('user_id'))->first();
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => env('AI_CHATUSER_URL').'/users'.'/'.$user->chatuser_id.'/chat',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.env('AI_CHATUSER_APIKEY')
        ),
        ));

        $fetchfirst = Messages::where('user_id',session('user_id'))->where('isDeleted', 0)->get();
        $profile = Messages::where('user_id',session('user_id'))->where('isDeleted', 0)->first();

        $profile_id = isset($profile->profile_id) ? $profile->profile_id : '';
        // Get the count of records
          $count = $fetchfirst->count();
          if($count < 0){
            return 1;
          }
          
        $response = curl_exec($curl);
        curl_close($curl);
        return response()->json(['data' => $profile_id]);
    }

    public function Ischeckdeleted($id)
    {
        $user = User::where('id', session('user_id'))->where('deletechat_flag',1)->first();
        if(isset($user)){
            if($user->deletechat_flag == 1)
            {
                Messages::where('profile_id', $_GET['Id'])->where('guid','!=',0)->update(['isDeleted' => 1]);
            }else{
                Messages::where('sender_id',$_GET['Id'])->where('receiver_id', session('user_id'))->where('isDeleted', 0)->orderBy('guid', 'DESC')->update(['isDeleted' => 1]);
            }
            
            
        }
    }

    public function checkStringForWord($show, $persona_id ,$prompt, $negative_prompt, $globle_realistic_prompts, $globle_anime_prompts ,$globle_realistic_terms ,$globle_anime_terms, $restore_faces, $seed, $denoising_strength, $enable_hr, $hr_scale, $hr_upscaler, $sampler_index, $email, $steps, $cfg_scale, $profile_id, $first_message, $image_prompt ,$negative_profile_prompt) {

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => env('AI_CHATUSER_URL').'/personas'.'/'.$persona_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.env('AI_CHATUSER_APIKEY')
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
            $responseArray = json_decode($response, true);
            if (isset($responseArray['data']['system_prompt'])) {
                $responseArray = $responseArray['data']['system_prompt'];
            } else {
                return back()->withErrors(['ai_message' => 'Message and person not found in the response'])->withInput();  
            }
            $data = '{
                "input": {
                    "api_name": "txt2img",
                    "prompt": "'. $show .','.str_replace(["\n", "\r", '"'], '', $image_prompt).','.str_replace(["\n", "\r", '"'], '', $globle_realistic_prompts).','.str_replace(["\n", "\r", '"'], '', $globle_realistic_terms).'",
                    "restore_faces": '.$restore_faces.',
                    "negative_prompt": "'. str_replace(["\n", "\r"], ' ', $negative_prompt).','. str_replace(["\n", "\r"], ' ', $negative_profile_prompt).'",
                    "seed": '.$seed.',
                    "override_settings": {
                        "sd_model_checkpoint": ""
                    },
                    "cfg_scale": '.$cfg_scale.',
                    "denoising_strength": '.$denoising_strength.',
                    "enable_hr": '.$enable_hr.',
                    "hr_scale":'.$hr_scale.',
                    "hr_upscaler": "'.$hr_upscaler.'",
                    "sampler_index": "'.$sampler_index.'",
                    "steps": '.$steps.',
                    "email": "'.$email.'"
                }
            }';
            $maxRetries = 3; // Set the maximum number of retries
            $retryDelay = 1; // Set the delay between retries in seconds

            for ($retry = 0; $retry < $maxRetries; $retry++) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => env('AI_IMAGE_URL').'/'.env('AI_IMAGE_USER').'/run',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>$data,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.env('AI_IMAGE_KEY'),
                    'Cookie: __cflb=0H28v2ycMsGacX9vfRBHNL4Xf6Pqy6UtsaGmFx2YDxQ'
                ),
                ));
                $response_image = curl_exec($curl);
                if (curl_errno($curl)) {
                    $curlError = curl_error($curl);
                        // Check if the error is a timeout
                        if (strpos($curlError, 'Operation timed out') !== false) {
                        
                            sleep($retryDelay); 
                            continue;
                        } else {
                            echo 'Curl error: ' . $curlError;
                            break; 
                        }
                    }
                    curl_close($curl);
                    break; 
                }

                $response_image = json_decode($response_image, true);
                $response_image_id = '';
                if (isset($response_image['id'])) {
                    $response_image_id  = $response_image['id'];
                    // store response
                    // Create a timestamp
                    $timestamp = date('Y-m-d H:i:s');
                    // Combine the timestamp and the response array
                    $dataToWrite = "Timestamp: $timestamp\n\n Image request: ". print_r($data, true) ." \nImage ID: ". print_r($response_image_id, true) ."";
                    // Define the file path
                    $filePath = 'Image-API-Response.txt';
                    // Open the file in append mode, or create it if it doesn't exist
                    $file = fopen($filePath, 'a');
                    // Write the data to the file
                    fwrite($file, $dataToWrite);
                    // Close the file
                    fclose($file);
                    // store response
                    $getMessageSequnce_guid = Messages::where('receiver_id', session('user_id'))->where('sender_id', $profile_id)->where('isDeleted', 0)->where('message_text', '!=', $first_message)->orderBy('guid', 'desc')->first();
    
                    $message_guid = array(
                        'profile_id'=> $profile_id,
                        'user_id'=> session('user_id'),
                        'sender_id'=> session('user_id'),
                        'receiver_id'=> $profile_id,
                        'status'=> 'Active',
                        'image_id' => $response_image_id,
                        'guid' => $getMessageSequnce_guid ? ($getMessageSequnce_guid->guid) : 0,
                        'sequence_message' => $getMessageSequnce_guid ? ($getMessageSequnce_guid->guid) : 0
                    );
                    Messages::create($message_guid);

                } else {
                    return back()->withErrors(['ai_message' => 'Message and person image not found in the response'])->withInput();  
                    die;
                }

                try {
                    $responseJson = $this->performInitialCheck($response_image_id);
                    $responseArray = json_decode($responseJson, true);

                    if (isset($responseArray)) {
                        while ($responseArray['status'] == "IN_PROGRESS" || $responseArray['status'] == "IN_QUEUE") {
                            // Introduce a delay between checks to avoid excessive requests
                            sleep(1);

                            $responseJson = $this->performInitialCheck($response_image_id);
                            $responseArray = json_decode($responseJson, true);

                            // Check if the status is now "COMPLETED"
                            if (isset($responseArray['status']) && $responseArray['status'] == "COMPLETED") {
                                if (isset($responseArray['output']['images'][0])) {
                                    $response_image_base64 = $responseArray['output']['images'][0];
                                    // $chatjson2 = array(
                                    //     'user_id'=> session('user_id'),
                                    //     'json'=> 'Image'.$responseJson,
                                    //     'image_base64'=> $responseArray['output']['images'][0],
                                    // );
                                    // Chatapi_responses::create($chatjson2);
                                    break;
                                }
                            }
                        }
                    } else {
                        // Handle the case where decoding fails
                        throw new \Exception("Failed to decode JSON response");
                    }
                } catch (\Exception $e) {
                    // Handle exceptions (e.g., log the error, notify the user, etc.)
                    //echo "Error: " . $e->getMessage();
                }

                if(isset($response_image_base64)){
                    $base64Image = $response_image_base64;
                    // Decode the Base64 image data
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
                    // Generate a unique filename for the image
                    $imageName = uniqid() . '.png';
                    //remove metadata G::Meta

                    // $chatjson2 = array(
                    //     'user_id'=> session('user_id'),
                    //     'json'=> 'test'.$responseJson,
                    //     'image_base64'=> $response_image_base64,
                    // );
                    // Chatapi_responses::create($chatjson2);

                    $image = Image::make(imagecreatefromstring($imageData));
                    $modifiedImagePath = storage_path($imageName);
                    // Remove all EXIF data from the image
                    $image->save($modifiedImagePath);
                    $image->exif([]);
                    $image->response('png');
                    sleep(1);

                    $imgUrl = env('APP_URL') ? env('APP_URL') . ('/storage'.'/'.$imageName) : url('/') . ('/storage'.'/'.$imageName);

                    $result = array(
                        'image_id' => $response_image_id,
                        'image_url' => $imgUrl
                    );
                    return $result;
                }

               return '';
    }


    public function liked($id)
    {
        Messages::where('message_id', $id)->update(['message_liked' => 'Liked']);
        return true;
    }

    public function unliked($id)
    {
        Messages::where('message_id', $id)->update([
            'feedback' => $_GET['message'],
            'message_liked' => 'Unliked'
        ]);
        return true;
    }
    private function performInitialCheck($response_image)
    {
        // Logic for the initial check
        // Return 'inprogress' if successful, otherwise return an appropriate value
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => env('AI_IMAGE_URL').'/'.env('AI_IMAGE_USER').'/'.'status/'.$response_image,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.env('AI_IMAGE_KEY'),
            'Cookie: __cflb=0H28v2ycMsGacX9vfRBHNL4Xf6Pqy6UtsaGmFx2YDxQ'
        ),
        ));

        $response_Base64 = curl_exec($curl);
        curl_close($curl);
        return $response_Base64;
    }
}