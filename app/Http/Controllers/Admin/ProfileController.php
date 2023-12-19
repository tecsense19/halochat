<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Globle_prompts;
use App\Models\ProfileImage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function addProfiles(Request $request)
    {
    if(!session()->has('authenticated_admin')){
        return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
    }
       $get_voice = $this->get_voice();
       return view('admin.profiles.addedit', compact('get_voice'));
    }

    public function profiles()
    {
        try{
            if(!session()->has('authenticated_admin')){
                return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
            }

            return view('admin.profiles.profile');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function profilesList(Request $request)
    {
        $input = $request->all();

        $search = $input['search'];

        $profileList = Profile::with('profileImages')
                        ->when($search, function ($query) use ($search) {
                            return $query->where(function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            });
                        })
                        ->paginate(10);

        return view('admin.profiles.list', compact('profileList'));
    }

    public function destroy($id)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
        // Find the resource you want to delete
        $profile = Profile::where('profile_id', $id)->first();

        // Check if the resource exists
        if (!$profile) {
            return redirect()->route('admin.profiles.list')->with('error', 'Profile not found');
        }

        // Perform the deletion
        $profile = Profile::where('profile_id', $id)->delete();

        return view('admin.profiles.addedit')->with('success', 'Profile deleted successfully');;
    }

    public function edit($id)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }

        $id = Crypt::decryptString($id);

        $checkProfile = Profile::where('profile_id', $id)->first();
        if($checkProfile)
        {
            $profileList = Profile::where('profile_id', $id)->first();
            $get_voice = $this->get_voice();
            return view('admin.profiles.addedit', compact('profileList', 'id', 'get_voice'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function get_voice()
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => env('AI_CHATUSER_URL').'/voices',
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
        return $response;
    }
    public function addGlobleprompts(Request $request) 
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
        $profilegloble = Globle_prompts::where('type', 'anime')->first();
        return view('admin.profiles.globleprompt', compact('profilegloble'));
    }
    public function addGloblepromptrealist(Request $request) 
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
        $profilegloble = Globle_prompts::where('type', 'realistic')->first();
        return view('admin.profiles.globlepromptrealist', compact('profilegloble'));
    }

    public function store_globleprompts(Request $request)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                'restore_faces' => 'required|string',
                'seed' => 'required|string',
                'denoising_strength' => 'required|string',
                'enable_hr' => 'required|string',
            ]);

            if ($validator->fails()) {

                return redirect()->route('admin.profile.globleprompt')->withErrors($validator);
                //return redirect()->route('admin.profile.addProfiles')->withErrors($validator)->withInput();
            }

            // Find or create the record based on a unique column (assuming 'id' is the primary key)
          if($input['type'] == 'anime')
          {
            Globle_prompts::updateOrCreate(
                ['type' => $input['type']], // The unique column (in this case, assuming 'id' is the primary key)
                [
                    'globle_realistic_prompts' => isset($input['globle_realistic_prompts']) ? $input['globle_realistic_prompts'] : '',
                    'globle_anime_prompts' => isset($input['globle_anime_prompts']) ? $input['globle_anime_prompts'] : '',
                    'globle_realistic_terms' => isset($input['globle_realistic_terms']) ? $input['globle_realistic_terms'] : '',
                    'globle_anime_terms' => isset($input['globle_anime_terms']) ? $input['globle_anime_terms'] : '',
                    'restore_faces' => isset($input['restore_faces']) ? $input['restore_faces'] : '',
                    'seed' => isset($input['seed']) ? $input['seed'] : '',
                    'denoising_strength' => isset($input['denoising_strength']) ? $input['denoising_strength'] : '',
                    'enable_hr' => isset($input['enable_hr']) ? $input['enable_hr'] : '',
                    'hr_scale' => isset($input['hr_scale']) ? $input['hr_scale'] : '',
                    'hr_upscaler' => isset($input['hr_upscaler']) ? $input['hr_upscaler'] : '',
                    'sampler_index' => isset($input['sampler_index']) ? $input['sampler_index'] : '',
                    'email' => isset($input['email']) ? $input['email'] : '',
                    'steps' => isset($input['steps']) ? $input['steps'] : '',
                    'prompt_Url' => isset($input['prompt_Url']) ? $input['prompt_Url'] : '',
                    'globle_anime_nagative_prompt' => isset($input['globle_anime_nagative_prompt']) ? $input['globle_anime_nagative_prompt'] : '',
                    'globle_realistic_nagative_prompt' => isset($input['globle_realistic_nagative_prompt']) ? $input['globle_realistic_nagative_prompt'] : '',
                    'wordsphrases' => isset($input['wordsphrases']) ? $input['wordsphrases'] : '',
                    'cfg_scale' => isset($input['cfg_scale']) ? $input['cfg_scale'] : '',
                    'type' => $input['type'],
                ]
            );
            
          $profilegloble = Globle_prompts::where('type', 'anime')->first();
         return view('admin.profiles.globleprompt', compact('profilegloble'));
          }

          if($input['type'] == 'realistic')
          {
            Globle_prompts::updateOrCreate(
                ['type' => $input['type']], // The unique column (in this case, assuming 'id' is the primary key)
                [
                    'globle_realistic_prompts' => isset($input['globle_realistic_prompts']) ? $input['globle_realistic_prompts'] : '',
                    'globle_anime_prompts' => isset($input['globle_anime_prompts']) ? $input['globle_anime_prompts'] : '',
                    'globle_realistic_terms' => isset($input['globle_realistic_terms']) ? $input['globle_realistic_terms'] : '',
                    'globle_anime_terms' => isset($input['globle_anime_terms']) ? $input['globle_anime_terms'] : '',
                    'restore_faces' => isset($input['restore_faces']) ? $input['restore_faces'] : '',
                    'seed' => isset($input['seed']) ? $input['seed'] : '',
                    'denoising_strength' => isset($input['denoising_strength']) ? $input['denoising_strength'] : '',
                    'enable_hr' => isset($input['enable_hr']) ? $input['enable_hr'] : '',
                    'hr_scale' => isset($input['hr_scale']) ? $input['hr_scale'] : '',
                    'hr_upscaler' => isset($input['hr_upscaler']) ? $input['hr_upscaler'] : '',
                    'sampler_index' => isset($input['sampler_index']) ? $input['sampler_index'] : '',
                    'email' => isset($input['email']) ? $input['email'] : '',
                    'steps' => isset($input['steps']) ? $input['steps'] : '',
                    'prompt_Url' => isset($input['prompt_Url']) ? $input['prompt_Url'] : '',
                    'globle_anime_nagative_prompt' => isset($input['globle_anime_nagative_prompt']) ? $input['globle_anime_nagative_prompt'] : '',
                    'globle_realistic_nagative_prompt' => isset($input['globle_realistic_nagative_prompt']) ? $input['globle_realistic_nagative_prompt'] : '',
                    'wordsphrases' => isset($input['wordsphrases']) ? $input['wordsphrases'] : '',
                    'cfg_scale' => isset($input['cfg_scale']) ? $input['cfg_scale'] : '',
                    'type' => $input['type'],
                ]
            );
            
            $profilegloble = Globle_prompts::where('type', 'realistic')->first();
        return view('admin.profiles.globlepromptrealist', compact('profilegloble'));
          }
            
    }
    catch (\Exception $e) {
        dd($e->getMessage());
        }
            $profilegloble = Globle_prompts::first();
            return redirect()->route('admin.profiles.globleprompt', compact('profilegloble'));
           
    }


    public function store(Request $request)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }   
        
        try {
        $input = $request->all();
        if(!empty($input['speakerBoostCheckbox']))
        {
            $speakerBoostCheckbox = 1;
            $speakerBoostCheckboxreq = true;
        }else{
            $speakerBoostCheckbox = 0;
            $speakerBoostCheckboxreq = false;
        }

        if(isset($input['eleven_monolingual_v1']))
        {
            $multiplemodel = $input['eleven_multilingual_v2'].'/'.$input['eleven_monolingual_v1'];
        }else{
            $multiplemodel = $input['eleven_multilingual_v2'];
        }

        $postfiled = '{
            "name": "'.$input['profile_name'].'",
            "system_prompt": "'.$input['system_prompt'].'",
            "system_instruction": "'.$input['system_instruction'].'",
            "voice_name": "'.$input['profile_get_voice'].'",
            "voice_model": "'.$multiplemodel.'",
            "voice_settings": {
                "stability": '.$input['stability'].',
                "similarity_boost": '.$input['similarity_boost'].',
                "style": '.$input['style'].',
                "use_speaker_boost": '.$speakerBoostCheckboxreq.'
            },
            "short_description": "'.$input['profile_body_description'].'",
            "first_message": "'.$input['first_message'].'"
        }';
        
        $validator = Validator::make($input, [
            'profile_name' => 'required|string',
            'profile_ethnicity' => 'required|string',
            'profile_personality' => 'required|string',
            'profile_age' => 'required|string',
            'profile_gender' => 'required|string',
            'profile_occupation' => 'required|string',
            'profile_hobbies' => 'required|string',
            'profile_relationship_status' => 'required|string',
            'profile_body_description' => 'required|string',
            'description' => 'required|string',
            'system_prompt' => 'required|string',
            'system_instruction' => 'required|string',
            'max_ai_reply_length' => 'required|integer|min:1|max:5000',
            'max_prompt_length' => 'required|integer|min:1|max:5000',
            // 'prompt' => 'required|string',
            // 'negative_prompt' => 'required|string',
            'profile_personatype' => 'required',
        ]);
        
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
            //return redirect()->route('admin.profile.addProfiles')->withErrors($validator)->withInput();
        }
        else {
           
            $profile_update = Profile::where('profile_id',$input['profile_id'])->first();
            if($profile_update)
            {
                
                    // update profile
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => env('AI_CHATUSER_URL').'/personas'.'/'.$profile_update->persona_id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'PUT',
                    CURLOPT_POSTFIELDS => $postfiled,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Basic '.env('AI_CHATUSER_APIKEY')
                    ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);

                $profile_update = Profile::where('profile_id', $input['profile_id'])->update([
                    'name' => $input['profile_name'],
                    'ethnicity' => $input['profile_ethnicity'],
                    'personality' => $input['profile_personality'],
                    'age' => $input['profile_age'],
                    'subscription_type' => $input['subscription_type'],
                    'gender' => $input['profile_gender'],
                    'occupation' => $input['profile_occupation'],
                    'hobbies' => $input['profile_hobbies'],
                    'relationship_status' => $input['profile_relationship_status'],
                    'body_description' => $input['profile_body_description'],
                    'description' => $input['description'],
                    'voice_name' => $input['profile_get_voice'],
                    'voice_id' => $input['voice_id'],
                    'voice_model' => $multiplemodel,
                    'voice_preview_url' => $input['audio_url'],
                    'first_message' => $input['first_message'],
                    'system_prompt' => $input['system_prompt'],
                    'system_instruction' => $input['system_instruction'],
                    'stability' => $input['stability'],
                    'similarity_boost' => $input['similarity_boost'],
                    'max_prompt_length' => $input['max_prompt_length'],
                    'max_ai_reply_length' => $input['max_ai_reply_length'],
                    'short_description'=> $input['short_description'],
                    'style' => $input['style'],
                    'use_speaker_boost' => $speakerBoostCheckbox,
                    // 'prompt' => $input['prompt'],
                    // 'negative_prompt' => $input['negative_prompt'],
                    'personatype' => $input['profile_personatype'],
                ]);
                $profileId = $input['profile_id'];
                if ($request->hasFile('profile_img')) {
                    foreach ($request->file('profile_img') as $image) {
                        $imagePath = $image->store('images', 'public');
                        ProfileImage::create([
                            'profile_id' => $profileId, // Set the appropriate profile_id
                            'image_path' => $imagePath,
                            'is_primary' => 0, // You can set is_primary as needed
                        ]);
                    }
                }
            }else{
               // add profile
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => env('AI_CHATUSER_URL').'/personas',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => $postfiled,
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Basic '.env('AI_CHATUSER_APIKEY')
                  ),
                ));

                $response = curl_exec($curl);
                $responseArray = json_decode($response, true);

                if (isset($responseArray['data']['persona_id'])) {
                    $personaId = $responseArray['data']['persona_id'];
                } else {
                    return back()->withErrors(['ai_persona' => 'Persona ID not found in the response.'])->withInput();
                }
                
            $profile = new Profile;
            $profile->name = $input['profile_name'];
            $profile->ethnicity = $input['profile_ethnicity'];
            $profile->personality = $input['profile_personality'];
            $profile->age = $input['profile_age'];
            $profile->subscription_type = $input['subscription_type'];
            $profile->gender = $input['profile_gender'];
            $profile->occupation = $input['profile_occupation'];
            $profile->hobbies = $input['profile_hobbies'];
            $profile->relationship_status = $input['profile_relationship_status'];
            $profile->body_description = $input['profile_body_description'];
            $profile->description = $input['description'];
            $profile->voice_name = $input['profile_name'];
            $profile->voice_model = $multiplemodel;
            $profile->voice_id = $input['voice_id'];
            $profile->voice_preview_url = $input['audio_url'];
            $profile->persona_id = $personaId;
            $profile->first_message = $input['first_message'];  
            $profile->system_prompt = $input['system_prompt'];
            $profile->system_instruction = $input['system_instruction'];
            $profile->stability = $input['stability'];
            $profile->similarity_boost = $input['similarity_boost'];
            $profile->style = $input['style'];
            $profile->max_prompt_length = $input['max_prompt_length'];
            $profile->max_ai_reply_length = $input['max_ai_reply_length'];
            $profile->short_description = $input['short_description'];
            $profile->use_speaker_boost = $speakerBoostCheckbox;
            $profile->save(); // Save the profile data
            $profileId = $profile->id;
               
                if ($request->hasFile('profile_img')) {
                    foreach ($request->file('profile_img') as $image) {
                        // Store the image file in a directory (you can use Laravel's Storage facade)
                        $imagePath = $image->store('images', 'public');
        
                        // Insert a record into the profile_images table
                        ProfileImage::create([
                            'profile_id' => $profileId, // Set the appropriate profile_id
                            'image_path' => $imagePath,
                            'is_primary' => 0, // You can set is_primary as needed
                        ]);
                    }
                }
            }
        }     
    }
    catch (\Exception $e) {
    dd($e->getMessage());
    }
        $profileList = Profile::with('profileImages')->get();
        return redirect()->route('admin.profile.list', compact('profileList'));
       
    }

    public function deleteImage(Request $request)
        {
            if(!session()->has('authenticated_admin')){
                return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
            }
            // Delete the old profile image file from the server
            if (ProfileImage::exists(public_path($request->image_path))) {
                ProfileImage::where('image_path', $request->image_path)->delete();
                return 'success';
            }else
            {
                echo "no";
            }


            // return redirect()->back();
        }


}