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
        $profile_name = Profile::where('profile_id', $_GET['id'])->first();
        return view("front.chat.bind", compact('getAllReciverUser', 'profile_name'));

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
                if (str_contains(strtolower($message_show), 'show') || str_contains(strtolower($message_show), 'can i see...') || str_contains(strtolower($message_show), 'send') || str_contains(strtolower($message_show), 'send me...')) {
                    if($creditAddManage->currentcredit >= 2)
                    {
                        // $subscriptionsUser = Subscriptions::where('user_id', session('user_id'))->first();
                        // if(!empty($subscriptionsUser)){
                            $message_url = $this->checkStringForWord($message_show,
                            $user->persona_id,
                            $user->prompt,
                            $globleprompts->args,
                            $globleprompts->method,
                            $globleprompts->endpoint,
                            $globleprompts->sd_model_checkpoint,
                            $globleprompts->sd_vae,
                            $globleprompts->width,
                            $globleprompts->height,
                            $globleprompts->sampler_name,
                            $globleprompts->override_settings_restore_afterwards,
                            $globleprompts->ad_cfg_scale,
                            $globleprompts->ad_checkpoint,
                            $globleprompts->ad_clip_skip,
                            $globleprompts->ad_confidence,
                            $globleprompts->ad_controlnet_guidance_end,
                            $globleprompts->ad_controlnet_guidance_start,
                            $globleprompts->ad_controlnet_model,
                            $globleprompts->ad_controlnet_module,
                            $globleprompts->ad_controlnet_weight,
                            $globleprompts->ad_denoising_strength,
                            $globleprompts->ad_dilate_erode,
                            $globleprompts->ad_inpaint_height,
                            $globleprompts->ad_inpaint_only_masked,
                            $globleprompts->ad_inpaint_only_masked_padding,
                            $globleprompts->ad_inpaint_width,
                            $globleprompts->ad_mask_blur,
                            $globleprompts->ad_mask_k_largest,
                            $globleprompts->ad_mask_max_ratio,
                            $globleprompts->ad_mask_merge_invert,
                            $globleprompts->ad_mask_min_ratio,
                            $globleprompts->ad_model,
                            $globleprompts->ad_negative_prompt,
                            $globleprompts->ad_noise_multiplier,
                            $globleprompts->ad_prompt,
                            $globleprompts->ad_restore_face,
                            $globleprompts->ad_sampler,
                            $globleprompts->ad_steps,
                            $globleprompts->ad_use_cfg_scale,
                            $globleprompts->ad_use_checkpoint,
                            $globleprompts->ad_use_clip_skip,
                            $globleprompts->ad_use_inpaint_width_height,
                            $globleprompts->ad_use_noise_multiplier,
                            $globleprompts->ad_use_sampler,
                            $globleprompts->ad_use_steps,
                            $globleprompts->ad_use_vae,
                            $globleprompts->ad_vae,
                            $globleprompts->ad_x_offset,
                            $globleprompts->ad_y_offset,
                            $globleprompts->is_api,
                            $globleprompts->seed,
                            $globleprompts->denoising_strength,
                            $globleprompts->enable_hr,
                            $globleprompts->hr_scale,
                            $globleprompts->hr_upscaler,
                            $globleprompts->sampler_index,
                            $globleprompts->email,
                            $globleprompts->steps,
                            $globleprompts->cfg_scale,
                            $user->profile_id,
                            $user->first_message,
                            $user->image_prompt,
                            $user->negative_prompt,
                            $user->lora_input);    
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
                        // 'guid' => $getMessageSequnce ? ($getMessageSequnce->guid) : 0,
                        // 'sequence_message' => $getMessageSequnce ? ($getMessageSequnce->guid) : 0,
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

                $system_prompt = preg_replace('/\s+/', ' ', json_encode(str_replace(["\n", "\r", '"'], ' ', $getFirstMessage->system_prompt)));
                $system_instruction = preg_replace('/\s+/', ' ', json_encode(str_replace(["\n", "\r", '"'], ' ', $getFirstMessage->system_instruction)));

                $postfeild = '{
                            "user_message": "'.str_replace(["\n", "\r", '"'], '', $message).'",
                            "persona_id": "'.$getFirstMessage->persona_id.'",
                            "max_completion_tokens": '.$getFirstMessage->max_prompt_length.',
                            "max_prompt_words": '.$getFirstMessage->max_ai_reply_length.',
                            "request_id": "'.$sequnce_number.'",
                            "reply_with_voice": '.$getFirstMessage->reply_with_voice.',
                            "persona": {
                            "name": "'.$getFirstMessage->name.'",
                            "system_prompt": '.$system_prompt.',
                            "system_instruction": '.$system_instruction.',
                            "voice_name": "'.$getFirstMessage->voice_id.'",
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


                    $curlvoice = curl_init();
                    curl_setopt_array($curlvoice, array(
                    CURLOPT_URL => env('TEXT_TO_VOICE_URL').'/'.'text-to-speech/'.$getFirstMessage->voice_id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                    "model_id": "'.$getFirstMessage->voice_model.'",
                    "text": '.json_encode($responseObject->data->ai_message).',
                    "voice_settings": {
                                "stability": '.$getFirstMessage->stability.',
                                "similarity_boost": '.$getFirstMessage->similarity_boost.',
                                "style": '.$getFirstMessage->style.',
                                "use_speaker_boost": '.$getFirstMessage->use_speaker_boost.'
                    }
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'xi-api-key: '.env('TEXT_TO_VOICE_KEY'),
                        'Content-Type: application/json'
                    ),
                    ));

                    $responsevoice = curl_exec($curlvoice);
                    curl_close($curlvoice);
                    if ($responsevoice === false) {
                        echo 'Error in API request';
                        exit;
                    }
                    // Replace 'path/to/save/file.mp3' with the desired file path and name
                    $filePath1 = 'storage/'.uniqid().'.mp3';
                    // Save the MP3 data to a file
                    file_put_contents($filePath1, $responsevoice);

                        if (isset($responseObject->data->ai_message)) {
                            $this->creditcut($profile_id,$responseObject->data->ai_message,$responseObject->data->request_id,$userId,$creditAddManage,$filePath1);
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

    public function creditcut($profile_id,$responseObjectAi_message,$responseObjectRequest_id,$userId,$creditAddManage,$voiceMessagePath)
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
            'voicemessagepath' => $voiceMessagePath,
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
        $userName = User::where('id', session('user_id'))->first();
        if($user)
        {
            $MessageData = Messages::where('sender_id', session('user_id'))->where('receiver_id', $user->profile_id)->where('isDeleted' , 0)->first();

            if(!$MessageData){

                if(session('user_id'))
                {
                    User::where('id', session('user_id'))->update(['deletechat_flag' => 0]);
                    if (str_contains($user->first_message, '{{first_name}}')) {
                        // Replace {{first_name}} with the actual first name
                        $messageText = str_replace('{{first_name}}', $user->name, $user->first_message);
                    }else{
                        $messageText = $user->first_message;
                    } 

                    if (str_contains($user->first_message, '{{username}}')) {
                        // Replace {{username}} with the actual username
                        $messageText = str_replace('{{username}}', $userName->name, $messageText);
                    }else{
                        $messageText = $user->first_message;
                    } 

                    // first voice message
                    $curlvoice = curl_init();
                    curl_setopt_array($curlvoice, array(
                    CURLOPT_URL => env('TEXT_TO_VOICE_URL').'/'.'text-to-speech/'.$user->voice_id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                    "model_id": "'.$user->voice_model.'",
                    "text": '.json_encode($messageText).',
                    "voice_settings": {
                                "stability": '.$user->stability.',
                                "similarity_boost": '.$user->similarity_boost.',
                                "style": '.$user->style.',
                                "use_speaker_boost": '.$user->use_speaker_boost.'
                    }
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'xi-api-key: '.env('TEXT_TO_VOICE_KEY'),
                        'Content-Type: application/json'
                    ),
                    ));

                    $responsevoice = curl_exec($curlvoice);
                    curl_close($curlvoice);
                    if ($responsevoice === false) {
                        echo 'Error in API request';
                        exit;
                    }
                    // Replace 'path/to/save/file.mp3' with the desired file path and name
                    $filePath1 = 'storage/'.uniqid().'.mp3';
                    // Save the MP3 data to a file
                    file_put_contents($filePath1, $responsevoice);

                    // first voice message

                    $message = array(
                        'profile_id'=> $user->profile_id,
                        'user_id'=> session('user_id'),
                        'sender_id'=> session('user_id'),
                        'receiver_id'=>  $user->profile_id,
                        'status'=> 'Active',
                        'message_text'=> $user->first_message,
                        'sequence_message'=> 0,
                        'guid'=> 0,
                        'voicemessagepath' => $filePath1, 
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

    public function checkStringForWord($show, $persona_id ,$prompt, $args,
    $method,
    $endpoint,
    $sd_model_checkpoint,
    $sd_vae,
    $width,
    $height,
    $sampler_name,
    $override_settings_restore_afterwards,
    $ad_cfg_scale,
    $ad_checkpoint,
    $ad_clip_skip,
    $ad_confidence,
    $ad_controlnet_guidance_end,
    $ad_controlnet_guidance_start,
    $ad_controlnet_model,
    $ad_controlnet_module,
    $ad_controlnet_weight,
    $ad_denoising_strength,
    $ad_dilate_erode,
    $ad_inpaint_height,
    $ad_inpaint_only_masked,
    $ad_inpaint_only_masked_padding,
    $ad_inpaint_width,
    $ad_mask_blur,
    $ad_mask_k_largest,
    $ad_mask_max_ratio,
    $ad_mask_merge_invert,
    $ad_mask_min_ratio,
    $ad_model,
    $ad_negative_prompt,
    $ad_noise_multiplier,
    $ad_prompt,
    $ad_restore_face,
    $ad_sampler,
    $ad_steps,
    $ad_use_cfg_scale,
    $ad_use_checkpoint,
    $ad_use_clip_skip,
    $ad_use_inpaint_width_height,
    $ad_use_noise_multiplier,
    $ad_use_sampler,
    $ad_use_steps,
    $ad_use_vae,
    $ad_vae,
    $ad_x_offset,
    $ad_y_offset,
    $is_api,
    $seed,
    $denoising_strength,
    $enable_hr,
    $hr_scale,
    $hr_upscaler,
    $sampler_index, 
    $email, 
    $steps,
    $cfg_scale,
    $profile_id,
    $first_message,
    $image_prompt,
    $negative_profile_prompt,
    $lora_input) {

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
            // $data = '{
            //     "input": {
            //         "api_name": "txt2img",
            //         "prompt": "'. $show .','.str_replace(["\n", "\r", '"'], '', $image_prompt).','.str_replace(["\n", "\r", '"'], '', $globle_realistic_prompts).','.str_replace(["\n", "\r", '"'], '', $globle_realistic_terms).'",
            //         "restore_faces": '.$restore_faces.',
            //         "negative_prompt": "'. str_replace(["\n", "\r"], ' ', $negative_prompt).','. str_replace(["\n", "\r"], ' ', $negative_profile_prompt).'",
            //         "seed": '.$seed.',
            //         "override_settings": {
            //             "sd_model_checkpoint": ""
            //         },
            //         "cfg_scale": '.$cfg_scale.',
            //         "denoising_strength": '.$denoising_strength.',
            //         "enable_hr": '.$enable_hr.',
            //         "hr_scale":'.$hr_scale.',
            //         "hr_upscaler": "'.$hr_upscaler.'",
            //         "sampler_index": "'.$sampler_index.'",
            //         "steps": '.$steps.',
            //         "email": "'.$email.'"
            //     }
            // }';

                $ad_cfg_scale = explode(',', $ad_cfg_scale);
                $ad_cfg_scale0 = isset($ad_cfg_scale[0] ) ? $ad_cfg_scale[0] : '';
                $ad_cfg_scale1 = isset($ad_cfg_scale[1] ) ? $ad_cfg_scale[1] : '';


                $ad_checkpoint = explode(',', $ad_checkpoint);
                $ad_checkpoint0 = isset($ad_checkpoint[0] ) ? $ad_checkpoint[0] : '';
                $ad_checkpoint1 = isset($ad_checkpoint[1] ) ? $ad_checkpoint[1] : '';

                $ad_clip_skip = explode(',', $ad_clip_skip);
                $ad_clip_skip0 = isset($ad_clip_skip[0] ) ? $ad_clip_skip[0] : '';
                $ad_clip_skip1 = isset($ad_clip_skip[1] ) ? $ad_clip_skip[1] : '';

                $ad_confidence = explode(',', $ad_confidence);
                $ad_confidence0 = isset($ad_confidence[0] ) ? $ad_confidence[0] : '';
                $ad_confidence1 = isset($ad_confidence[1] ) ? $ad_confidence[1] : '';


                $ad_controlnet_guidance_end = explode(',', $ad_controlnet_guidance_end);
                $ad_controlnet_guidance_end0 = isset($ad_controlnet_guidance_end[0] ) ? $ad_controlnet_guidance_end[0] : '';
                $ad_controlnet_guidance_end1 = isset($ad_controlnet_guidance_end[1] ) ? $ad_controlnet_guidance_end[1] : '';

                $ad_controlnet_guidance_start = explode(',', $ad_controlnet_guidance_start);
                $ad_controlnet_guidance_start0 = isset($ad_controlnet_guidance_start[0] ) ? $ad_controlnet_guidance_start[0] : '';
                $ad_controlnet_guidance_start1 = isset($ad_controlnet_guidance_start[1] ) ? $ad_controlnet_guidance_start[1] : '';

                $ad_controlnet_model = explode(',', $ad_controlnet_model);
                $ad_controlnet_model0 = isset($ad_controlnet_model[0] ) ? $ad_controlnet_model[0] : '';
                $ad_controlnet_model1 = isset($ad_controlnet_model[1] ) ? $ad_controlnet_model[1] : '';

                $ad_controlnet_module = explode(',', $ad_controlnet_module);
                $ad_controlnet_module0 = isset($ad_controlnet_module[0] ) ? $ad_controlnet_module[0] : '';
                $ad_controlnet_module1 = isset($ad_controlnet_module[1] ) ? $ad_controlnet_module[1] : '';

                $ad_controlnet_weight = explode(',', $ad_controlnet_weight);
                $ad_controlnet_weight0 = isset($ad_controlnet_weight[0] ) ? $ad_controlnet_weight[0] : '';
                $ad_controlnet_weight1 = isset($ad_controlnet_weight[1] ) ? $ad_controlnet_weight[1] : '';

                $ad_denoising_strength = explode(',', $ad_denoising_strength);
                $ad_denoising_strength0 = isset($ad_denoising_strength[0] ) ? $ad_denoising_strength[0] : '';
                $ad_denoising_strength1 = isset($ad_denoising_strength[1] ) ? $ad_denoising_strength[1] : '';

                $ad_dilate_erode = explode(',', $ad_dilate_erode);
                $ad_dilate_erode0 = isset($ad_dilate_erode[0] ) ? $ad_dilate_erode[0] : '';
                $ad_dilate_erode1 = isset($ad_dilate_erode[1] ) ? $ad_dilate_erode[1] : '';

                $ad_inpaint_height = explode(',', $ad_inpaint_height);
                $ad_inpaint_height0 = isset($ad_inpaint_height[0] ) ? $ad_inpaint_height[0] : '';
                $ad_inpaint_height1 = isset($ad_inpaint_height[1] ) ? $ad_inpaint_height[1] : '';

                $ad_inpaint_only_masked = explode(',', $ad_inpaint_only_masked);
                $ad_inpaint_only_masked0 = isset($ad_inpaint_only_masked[0] ) ? $ad_inpaint_only_masked[0] : '';
                $ad_inpaint_only_masked1 = isset($ad_inpaint_only_masked[1] ) ? $ad_inpaint_only_masked[1] : '';


                $ad_inpaint_only_masked_padding = explode(',', $ad_inpaint_only_masked_padding);
                $ad_inpaint_only_masked_padding0 = isset($ad_inpaint_only_masked_padding[0] ) ? $ad_inpaint_only_masked_padding[0] : '';
                $ad_inpaint_only_masked_padding1 = isset($ad_inpaint_only_masked_padding[1] ) ? $ad_inpaint_only_masked_padding[1] : '';

                $ad_inpaint_width = explode(',', $ad_inpaint_width);
                $ad_inpaint_width0 = isset($ad_inpaint_width[0] ) ? $ad_inpaint_width[0] : '';
                $ad_inpaint_width1 = isset($ad_inpaint_width[1] ) ? $ad_inpaint_width[1] : '';

                $ad_mask_blur = explode(',', $ad_mask_blur);
                $ad_mask_blur0 = isset($ad_mask_blur[0] ) ? $ad_mask_blur[0] : '';
                $ad_mask_blur1 = isset($ad_mask_blur[1] ) ? $ad_mask_blur[1] : '';

                $ad_mask_k_largest = explode(',', $ad_mask_k_largest);
                $ad_mask_k_largest0 = isset($ad_mask_k_largest[0] ) ? $ad_mask_k_largest[0] : '';
                $ad_mask_k_largest1 = isset($ad_mask_k_largest[1] ) ? $ad_mask_k_largest[1] : '';

                $ad_mask_max_ratio = explode(',', $ad_mask_max_ratio);
                $ad_mask_max_ratio0 = isset($ad_mask_max_ratio[0] ) ? $ad_mask_max_ratio[0] : '';
                $ad_mask_max_ratio1 = isset($ad_mask_max_ratio[1] ) ? $ad_mask_max_ratio[1] : '';

                $ad_mask_merge_invert = explode(',', $ad_mask_merge_invert);
                $ad_mask_merge_invert0 = isset($ad_mask_merge_invert[0] ) ? $ad_mask_merge_invert[0] : '';
                $ad_mask_merge_invert1 = isset($ad_mask_merge_invert[1] ) ? $ad_mask_merge_invert[1] : '';

                $ad_mask_min_ratio = explode(',', $ad_mask_min_ratio);
                $ad_mask_min_ratio0 = isset($ad_mask_min_ratio[0] ) ? $ad_mask_min_ratio[0] : '';
                $ad_mask_min_ratio1 = isset($ad_mask_min_ratio[1] ) ? $ad_mask_min_ratio[1] : '';

                $ad_model = explode(',', $ad_model);
                $ad_model0 = isset($ad_model[0] ) ? $ad_model[0] : '';
                $ad_model1 = isset($ad_model[1] ) ? $ad_model[1] : '';

                $ad_negative_prompt = explode(',', $ad_negative_prompt);
                $ad_negative_prompt0 = isset($ad_negative_prompt[0] ) ? $ad_negative_prompt[0] : '';
                $ad_negative_prompt1 = isset($ad_negative_prompt[1] ) ? $ad_negative_prompt[1] : '';

                $ad_noise_multiplier = explode(',', $ad_noise_multiplier);
                $ad_noise_multiplier0 = isset($ad_noise_multiplier[0] ) ? $ad_noise_multiplier[0] : '';
                $ad_noise_multiplier1 = isset($ad_noise_multiplier[1] ) ? $ad_noise_multiplier[1] : '';

                $ad_prompt = explode(',', $ad_prompt);
                $ad_prompt0 = isset($ad_prompt[0] ) ? $ad_prompt[0] : '';
                $ad_prompt1 = isset($ad_prompt[1] ) ? $ad_prompt[1] : '';

                $ad_restore_face = explode(',', $ad_restore_face);
                $ad_restore_face0 = isset($ad_restore_face[0] ) ? $ad_restore_face[0] : '';
                $ad_restore_face1 = isset($ad_restore_face[1] ) ? $ad_restore_face[1] : '';

                $ad_sampler = explode(',', $ad_sampler);
                $ad_sampler0 = isset($ad_sampler[0] ) ? $ad_sampler[0] : '';
                $ad_sampler1 = isset($ad_sampler[1] ) ? $ad_sampler[1] : '';

                $ad_steps = explode(',', $ad_steps);
                $ad_steps0 = isset($ad_steps[0] ) ? $ad_steps[0] : '';
                $ad_steps1 = isset($ad_steps[1] ) ? $ad_steps[1] : '';

                $ad_use_cfg_scale = explode(',', $ad_use_cfg_scale);
                $ad_use_cfg_scale0 = isset($ad_use_cfg_scale[0] ) ? $ad_use_cfg_scale[0] : '';
                $ad_use_cfg_scale1 = isset($ad_use_cfg_scale[1] ) ? $ad_use_cfg_scale[1] : '';

                $ad_use_checkpoint = explode(',', $ad_use_checkpoint);
                $ad_use_checkpoint0 = isset($ad_use_checkpoint[0] ) ? $ad_use_checkpoint[0] : '';
                $ad_use_checkpoint1 = isset($ad_use_checkpoint[1] ) ? $ad_use_checkpoint[1] : '';

                $ad_use_clip_skip = explode(',', $ad_use_clip_skip);
                $ad_use_clip_skip0 = isset($ad_use_clip_skip[0] ) ? $ad_use_clip_skip[0] : '';
                $ad_use_clip_skip1 = isset($ad_use_clip_skip[1] ) ? $ad_use_clip_skip[1] : '';

                $ad_use_inpaint_width_height = explode(',', $ad_use_inpaint_width_height);
                $ad_use_inpaint_width_height0 = isset($ad_use_inpaint_width_height[0] ) ? $ad_use_inpaint_width_height[0] : '';
                $ad_use_inpaint_width_height1 = isset($ad_use_inpaint_width_height[1] ) ? $ad_use_inpaint_width_height[1] : '';

                $ad_use_noise_multiplier = explode(',', $ad_use_noise_multiplier);
                $ad_use_noise_multiplier0 = isset($ad_use_noise_multiplier[0] ) ? $ad_use_noise_multiplier[0] : '';
                $ad_use_noise_multiplier1 = isset($ad_use_noise_multiplier[1] ) ? $ad_use_noise_multiplier[1] : '';

                $ad_use_sampler = explode(',', $ad_use_sampler);
                $ad_use_sampler0 = isset($ad_use_sampler[0] ) ? $ad_use_sampler[0] : '';
                $ad_use_sampler1 = isset($ad_use_sampler[1] ) ? $ad_use_sampler[1] : '';

                $ad_use_steps = explode(',', $ad_use_steps);
                $ad_use_steps0 = isset($ad_use_steps[0] ) ? $ad_use_steps[0] : '';
                $ad_use_steps1 = isset($ad_use_steps[1] ) ? $ad_use_steps[1] : '';

                $ad_use_vae = explode(',', $ad_use_vae);
                $ad_use_vae0 = isset($ad_use_vae[0] ) ? $ad_use_vae[0] : '';
                $ad_use_vae1 = isset($ad_use_vae[1] ) ? $ad_use_vae[1] : '';

                $ad_vae = explode(',', $ad_vae);
                $ad_vae0 = isset($ad_vae[0] ) ? $ad_vae[0] : '';
                $ad_vae1 = isset($ad_vae[1] ) ? $ad_vae[1] : '';

                $ad_x_offset = explode(',', $ad_x_offset);
                $ad_x_offset0 = isset($ad_x_offset[0] ) ? $ad_x_offset[0] : '';
                $ad_x_offset1 = isset($ad_x_offset[1] ) ? $ad_x_offset[1] : '';

                $ad_y_offset = explode(',', $ad_y_offset);
                $ad_y_offset0 = isset($ad_y_offset[0] ) ? $ad_y_offset[0] : '';
                $ad_y_offset1 = isset($ad_y_offset[1] ) ? $ad_y_offset[1] : '';

                $is_api = explode(',', $is_api);
                $is_api0 = isset($is_api[0] ) ? $is_api[0] : '';
                $is_api1 = isset($is_api[1] ) ? $is_api[1] : '';

                $args = explode(',', $args);
                $args0 =  isset($args[0]) ? $args[0] : '';
                $args1 =  isset($args[1]) ? $args[1] : '';  

            $replacement = $lora_input;
            $search = '{{lora}}';
            $new_string = str_replace($search, $replacement, $image_prompt);
            $new_message = $show .', '.$new_string;
            $prompt = preg_replace('/\s+/', ' ', json_encode(str_replace(["\n", "\r", '"'], ' ', $new_message)));
            
            $data2 = '{
                "input": {
                    "api": {
                        "method": "'.$method.'",
                        "endpoint": "'.$endpoint.'"
                    },
                    "payload": {
                        "override_settings": {
                            "sd_model_checkpoint": "'.$sd_model_checkpoint.'",
                            "sd_vae": "'.$sd_vae.'"
                        },
                        "seed": '.$seed.',
                        "steps": '.$steps.',
                        "cfg_scale": '.$cfg_scale.',
                        "width": '.$width.',
                        "height": '.$height.',
                        "denoising_strength": '.$denoising_strength.',
                        "enable_hr": '.$enable_hr.',
                        "hr_scale":'.$hr_scale.',
                        "hr_upscaler": "'.$hr_upscaler.'",
                        "sampler_name":  "'.$sampler_name.'",
                        "negative_prompt": '.json_encode(str_replace(["\n", "\r", '"'], ' ', $negative_profile_prompt)).',
                        "override_settings_restore_afterwards": '.$override_settings_restore_afterwards.',
                        "prompt": '.$prompt.',
                        "alwayson_scripts": {
                            "ADetailer": {
                                "args": [
                                    true,
                                    false,
                                    {
                                        "ad_cfg_scale": 7,
                                        "ad_checkpoint": "Use same checkpoint",
                                        "ad_clip_skip": 1,
                                        "ad_confidence": 0.65,
                                        "ad_controlnet_guidance_end": 1,
                                        "ad_controlnet_guidance_start": 0,
                                        "ad_controlnet_model": "None",
                                        "ad_controlnet_module": "None",
                                        "ad_controlnet_weight": 1,
                                        "ad_denoising_strength": 0.4,
                                        "ad_dilate_erode": 4,
                                        "ad_inpaint_height": 512,
                                        "ad_inpaint_only_masked": true,
                                        "ad_inpaint_only_masked_padding": 32,
                                        "ad_inpaint_width": 512,
                                        "ad_mask_blur": 4,
                                        "ad_mask_k_largest": 0,
                                        "ad_mask_max_ratio": 1,
                                        "ad_mask_merge_invert": "None",
                                        "ad_mask_min_ratio": 0,
                                        "ad_model": "face_yolov8s.pt",
                                        "ad_negative_prompt": "chin bump, chin cleft",
                                        "ad_noise_multiplier": 1,
                                        "ad_prompt": "'.$lora_input.' Innocent face, makeup, slight smile, happy eyes",
                                        "ad_restore_face": false,
                                        "ad_sampler": "DPM++ 2M Karras",
                                        "ad_steps": 28,
                                        "ad_use_cfg_scale": false,
                                        "ad_use_checkpoint": false,
                                        "ad_use_clip_skip": false,
                                        "ad_use_inpaint_width_height": false,
                                        "ad_use_noise_multiplier": false,
                                        "ad_use_sampler": false,
                                        "ad_use_steps": false,
                                        "ad_use_vae": false,
                                        "ad_vae": "Use same VAE",
                                        "ad_x_offset": 0,
                                        "ad_y_offset": 0,
                                        "is_api": []
                                    },
                                    {
                                        "ad_cfg_scale": 7,
                                        "ad_checkpoint": "Use same checkpoint",
                                        "ad_clip_skip": 1,
                                        "ad_confidence": 0.3,
                                        "ad_controlnet_guidance_end": 1,
                                        "ad_controlnet_guidance_start": 0,
                                        "ad_controlnet_model": "None",
                                        "ad_controlnet_module": "None",
                                        "ad_controlnet_weight": 1,
                                        "ad_denoising_strength": 0.4,
                                        "ad_dilate_erode": 4,
                                        "ad_inpaint_height": 512,
                                        "ad_inpaint_only_masked": true,
                                        "ad_inpaint_only_masked_padding": 32,
                                        "ad_inpaint_width": 512,
                                        "ad_mask_blur": 4,
                                        "ad_mask_k_largest": 0,
                                        "ad_mask_max_ratio": 1,
                                        "ad_mask_merge_invert": "None",
                                        "ad_mask_min_ratio": 0,
                                        "ad_model": "hand_yolov8n.pt",
                                        "ad_negative_prompt": "Extra fingers, missing fingers",
                                        "ad_noise_multiplier": 1,
                                        "ad_prompt": "",
                                        "ad_restore_face": false,
                                        "ad_sampler": "DPM++ 2M Karras",
                                        "ad_steps": 28,
                                        "ad_use_cfg_scale": false,
                                        "ad_use_checkpoint": false,
                                        "ad_use_clip_skip": false,
                                        "ad_use_inpaint_width_height": false,
                                        "ad_use_noise_multiplier": false,
                                        "ad_use_sampler": false,
                                        "ad_use_steps": false,
                                        "ad_use_vae": false,
                                        "ad_vae": "Use same VAE",
                                        "ad_x_offset": 0,
                                        "ad_y_offset": 0,
                                        "is_api": []
                                    }
                                ]
                            }
            
                        }
                    }
                }
                }';



            //             "alwayson_scripts": {
            //                 "ADetailer": {
            //                     "args": [
            //                         '.$args0.',
            //                         '.$args1.',
            //                         {
            //                             "ad_cfg_scale": "'.$ad_cfg_scale0.'",
            //                             "ad_checkpoint": "'.$ad_checkpoint0.'",
            //                             "ad_clip_skip": "'.$ad_clip_skip0.'",
            //                             "ad_confidence": "'.$ad_confidence0.'",
            //                             "ad_controlnet_guidance_end": "'.$ad_controlnet_guidance_end0.'",
            //                             "ad_controlnet_guidance_start": "'.$ad_controlnet_guidance_start0.'",
            //                             "ad_controlnet_model": "'.$ad_controlnet_model0.'",
            //                             "ad_controlnet_module": "'.$ad_controlnet_module0.'",
            //                             "ad_controlnet_weight": "'.$ad_controlnet_weight0.'",
            //                             "ad_denoising_strength": "'.$ad_denoising_strength0.'",
            //                             "ad_dilate_erode": "'.$ad_dilate_erode0.'",
            //                             "ad_inpaint_height": "'.$ad_inpaint_height0.'",
            //                             "ad_inpaint_only_masked": "'.$ad_inpaint_only_masked0.'",
            //                             "ad_inpaint_only_masked_padding": "'.$ad_inpaint_only_masked_padding0.'",
            //                             "ad_inpaint_width": "'.$ad_inpaint_width0.'",
            //                             "ad_mask_blur": "'.$ad_mask_blur0.'",
            //                             "ad_mask_k_largest": "'.$ad_mask_k_largest0.'",
            //                             "ad_mask_max_ratio": "'.$ad_mask_max_ratio0.'",
            //                             "ad_mask_merge_invert": "'.$ad_mask_merge_invert0.'",
            //                             "ad_mask_min_ratio": "'.$ad_mask_min_ratio0.'",
            //                             "ad_model": "'.$ad_model0.'",
            //                             "ad_negative_prompt": "'.$ad_negative_prompt0.'",
            //                             "ad_noise_multiplier": "'.$ad_noise_multiplier0.'",
            //                             "ad_prompt": "'.$ad_prompt0.'",
            //                             "ad_restore_face": "'.$ad_restore_face0.'",
            //                             "ad_sampler": "'.$ad_sampler0.'",
            //                             "ad_steps": "'.$ad_steps0.'",
            //                             "ad_use_cfg_scale": "'.$ad_use_cfg_scale0.'",
            //                             "ad_use_checkpoint": "'.$ad_use_checkpoint0.'",
            //                             "ad_use_clip_skip": "'.$ad_use_clip_skip0.'",
            //                             "ad_use_inpaint_width_height": "'.$ad_use_inpaint_width_height0.'",
            //                             "ad_use_noise_multiplier": "'.$ad_use_noise_multiplier0.'",
            //                             "ad_use_sampler": "'.$ad_use_sampler0.'",
            //                             "ad_use_steps": "'.$ad_use_steps0.'",
            //                             "ad_use_vae": "'.$ad_use_vae0.'",
            //                             "ad_vae": "'.$ad_vae0.'",
            //                             "ad_x_offset": "'.$ad_x_offset0.'",
            //                             "ad_y_offset": "'.$ad_y_offset0.'",
            //                             "is_api": []
            //                         },
            //                         {
            //                             "ad_cfg_scale": "'.$ad_cfg_scale1.'",
            //                             "ad_checkpoint": "'.$ad_checkpoint1.'",
            //                             "ad_clip_skip": "'.$ad_clip_skip1.'",
            //                             "ad_confidence": "'.$ad_confidence1.'",
            //                             "ad_controlnet_guidance_end": "'.$ad_controlnet_guidance_end1.'",
            //                             "ad_controlnet_guidance_start": "'.$ad_controlnet_guidance_start1.'",
            //                             "ad_controlnet_model": "'.$ad_controlnet_model1.'",
            //                             "ad_controlnet_module": "'.$ad_controlnet_module1.'",
            //                             "ad_controlnet_weight": "'.$ad_controlnet_weight1.'",
            //                             "ad_denoising_strength": "'.$ad_denoising_strength1.'",
            //                             "ad_dilate_erode": "'.$ad_dilate_erode1.'",
            //                             "ad_inpaint_height": "'.$ad_inpaint_height1.'",
            //                             "ad_inpaint_only_masked": "'.$ad_inpaint_only_masked1.'",
            //                             "ad_inpaint_only_masked_padding": "'.$ad_inpaint_only_masked_padding1.'",
            //                             "ad_inpaint_width": "'.$ad_inpaint_width1.'",
            //                             "ad_mask_blur": "'.$ad_mask_blur1.'",
            //                             "ad_mask_k_largest": "'.$ad_mask_k_largest1.'",
            //                             "ad_mask_max_ratio": "'.$ad_mask_max_ratio1.'",
            //                             "ad_mask_merge_invert": "'.$ad_mask_merge_invert1.'",
            //                             "ad_mask_min_ratio": "'.$ad_mask_min_ratio1.'",
            //                             "ad_model": "'.$ad_model1.'",
            //                             "ad_negative_prompt": "'.$ad_negative_prompt1.'",
            //                             "ad_noise_multiplier": "'.$ad_noise_multiplier1.'",
            //                             "ad_prompt": "'.$ad_prompt1.'",
            //                             "ad_restore_face": "'.$ad_restore_face1.'",
            //                             "ad_sampler": "'.$ad_sampler1.'",
            //                             "ad_steps": "'.$ad_steps1.'",
            //                             "ad_use_cfg_scale": "'.$ad_use_cfg_scale1.'",
            //                             "ad_use_checkpoint": "'.$ad_use_checkpoint1.'",
            //                             "ad_use_clip_skip": "'.$ad_use_clip_skip1.'",
            //                             "ad_use_inpaint_width_height": "'.$ad_use_inpaint_width_height1.'",
            //                             "ad_use_noise_multiplier": "'.$ad_use_noise_multiplier1.'",
            //                             "ad_use_sampler": "'.$ad_use_sampler1.'",
            //                             "ad_use_steps": "'.$ad_use_steps1.'",
            //                             "ad_use_vae": "'.$ad_use_vae1.'",
            //                             "ad_vae": "'.$ad_vae1.'",
            //                             "ad_x_offset": "'.$ad_x_offset1.'",
            //                             "ad_y_offset": "'.$ad_y_offset1.'",
            //                             "is_api": []
            //                         }
            //                     ]
            //                 }
            //             }
            //         }
            //     }
            // }';

            // print_r($data2);
            // die;

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
                CURLOPT_POSTFIELDS =>$data2,
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
                    $dataToWrite = "Timestamp: $timestamp\n\n Image request: ". print_r($data2, true) ." \nImage ID: ". print_r($response_image_id, true) ."";
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
             
                if(isset($responseArray['output']['images'][0])){
                    $base64Image = $responseArray['output']['images'][0];
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
        CURLOPT_TIMEOUT => 60,
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