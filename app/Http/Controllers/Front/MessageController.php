<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Messages;
use App\Models\Profile;
use App\Models\Managecredit;
use App\Models\Globle_prompts;
use App\Models\Usedcredites;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;



class MessageController extends Controller
{
    public function userMessage(Request $request){
        
        $user = Profile::with('profileImages')->where('profile_id',$_POST['receiver_id'])->first();
        $message_show = $_POST['message']; // Assuming you're getting the message from a form input
        $message_url = "";
      

            if(empty($user->profile_id)){
                return back()->withErrors(['chat_persona' => 'Please select persona'])->withInput();  
            }

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
            $creditAddManage = Managecredit::where('user_id', session('user_id'))->first();
            
            if($creditAddManage->currentcredit == 0){
                return redirect()->route('subscription.subscription');
                
            }else{
                if (str_contains($message_show, 'show')) {
                    $globleprompts = Globle_prompts::where('type' , $user->personatype)->first();
                    
                    $message_url = $this->checkStringForWord($_POST['message'],$user->persona_id,$user->prompt,$globleprompts->globle_realistic_nagative_prompt,$globleprompts->globle_realistic_prompts,$globleprompts->globle_anime_prompts,$globleprompts->globle_realistic_terms,$globleprompts->globle_anime_terms,$globleprompts->restore_faces,$globleprompts->seed,$globleprompts->denoising_strength,$globleprompts->enable_hr,$globleprompts->hr_scale,$globleprompts->hr_upscaler,$globleprompts->sampler_index,$globleprompts->email,$globleprompts->steps,$globleprompts->cfg_scale);
                    }
                        $this->callAPI($userId->chatuser_id, $_POST['message'], $user->profile_id, $userId, $message_url);
                    
                
            }
            return redirect()->back();
        }else{
            
            return redirect()->route('login');
        }
           
    }

    public function callAPI($id, $message, $profile_id, $userId, $message_url)
    {
        {   
            $creditAddManage = Managecredit::where('user_id', $userId->id)->first();

            if($creditAddManage->currentcredit == 0){
                return "<script>alert('Your trail credit is over');</script>";
            }else{
                    if(filter_var($message_url, FILTER_VALIDATE_URL) !== false){
                        $messageAi = array(
                            'profile_id'=> $profile_id,
                            'user_id'=> session('user_id'),
                            'sender_id'=> session('user_id'),
                            'receiver_id'=>  $profile_id,
                            'status'=> 'Active',
                            'media_url' => $message_url,
                            'updated_at' => now(),
                        );
                        Messages::create($messageAi);
                        $creditAdd = Managecredit::updateOrInsert(
                            ['user_id' => $userId->id],
                            [
                                'currentcredit' => $creditAddManage->currentcredit - 5,
                                'usedcredit' => $creditAddManage->usedcredit + 1,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]
                        );

                        Usedcredites::Insert(
                            [
                                'user_id' => $userId->id,
                                'debit' => 5,
                                'credit_debit_date' => now(),
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]
                        );
                        }else{
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
                                    return back()->withErrors(['ai_message' => 'Message not found in the response'])->withInput();  
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
                                $creditAdd = Managecredit::updateOrInsert(
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
            }
        }
    }
    public function index(Request $request, $id)
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

    public function delete($id)
    {
        Messages::where('profile_id', $id)->update(['isDeleted' => 1]);
        return redirect()->back();
    }

    public function checkStringForWord($show, $persona_id ,$prompt, $negative_prompt, $globle_realistic_prompts, $globle_anime_prompts ,$globle_realistic_terms ,$globle_anime_terms, $restore_faces, $seed, $denoising_strength, $enable_hr, $hr_scale, $hr_upscaler, $sampler_index, $email, $steps, $cfg_scale) {

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
                    "prompt": "'. $show .','.str_replace(["\n", "\r", '"'], '', $globle_realistic_prompts).','.str_replace(["\n", "\r", '"'], '', $globle_realistic_terms).'",
                    "restore_faces": '.$restore_faces.',
                    "negative_prompt": "'. str_replace(["\n", "\r"], ' ', $negative_prompt).'",
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

            // echo "<pre>";
            // print_r($data);
            // die;
                 $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => env('AI_IMAGE_URL').'/'.env('AI_IMAGE_USER').'/run',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
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
                curl_close($curl);
                // echo $response_image;    
                $response_image = json_decode($response_image, true);
                if (isset($response_image['id'])) {
                    $response_image = $response_image['id'];
                } else {
                    return back()->withErrors(['ai_message' => 'Message and person image not found in the response'])->withInput();  
                    die;
                }
                sleep(10);
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

                $response_Base64 = json_decode($response_Base64, true);
                if (isset($response_Base64['output']['images'][0])) {
                    $response_image = $response_Base64['output']['images'][0];
                } else {
                    return back()->withErrors(['ai_message' => 'Message and image not found in the response'])->withInput();
                    exit;
                }   

                if(isset($response_image)){
                    // $base64Image = $response_image;

                    // // Decode the Base64 image data
                    // $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
                
                    // // Generate a unique filename for the image
                    // $imageName = uniqid() . '.png';
                
                    // // Specify the storage disk you want to use (e.g., 'public' or 's3')
                    // $disk = 'public';
                
                    // // Save the image to the specified disk
                    // Storage::disk($disk)->put($imageName, $imageData);
                
                    // // Generate the URL for the saved image
                    // $imageUrl = Storage::disk($disk)->url('/app/public/'.$imageName);
                    // // return response()->json(['image_url' => $imageUrl]);
                    // return $imageUrl;
                    $base64Image = $response_image;
                    // Decode the Base64 image data
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
                    // Generate a unique filename for the image
                    $imageName = uniqid() . '.png';
                    $image = Image::make(imagecreatefromstring($imageData));
                    $modifiedImagePath = storage_path($imageName);
                    // Remove all EXIF data from the image
                    $image->save($modifiedImagePath);
                    $image->exif([]);
                    $image->response('png');
                    return url('storage/'.$imageName);
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
}