<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfileImage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function addProfiles(Request $request)
    {
       $get_voice = $this->get_voice();
       return view('admin.profiles.addedit', compact('get_voice'));
    }

    public function profiles()
    {
        try{
            $profileList = Profile::with('profileImages')->get();
            return view('admin.profiles.list' , compact('profileList'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
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
        $profileList = Profile::where('profile_id', $id)->first();
        $get_voice = $this->get_voice();
        return view('admin.profiles.addedit', compact('profileList', 'id', 'get_voice'));
    }

    public function get_voice()
    {
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

    public function store(Request $request)
    {
        try {
        $input = $request->all();

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
        ]);
        
        if ($validator->fails()) {

            return redirect()->route('admin.profile')->withErrors($validator);
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
                    CURLOPT_POSTFIELDS =>'{
                        "name": "'.$input['profile_name'].'",
                        "system_prompt": "'.$input['system_prompt'].'",
                        "system_instruction": "'.$input['system_instruction'].'",
                        "voice_name": "'.$input['profile_get_voice'].'",
                        "voice_model": "eleven_multilingual_v2",
                        "voice_settings": {
                            "stability": 0.5,
                            "similarity_boost": 0.75,
                            "style": 0,
                            "use_speaker_boost": true
                        },
                        "short_description": "'.$input['profile_body_description'].'",
                        "first_message": "'.$input['first_message'].'"
                    }',
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
                    'gender' => $input['profile_gender'],
                    'occupation' => $input['profile_occupation'],
                    'hobbies' => $input['profile_hobbies'],
                    'relationship_status' => $input['profile_relationship_status'],
                    'body_description' => $input['profile_body_description'],
                    'description' => $input['description'],
                    'voice_name' => $input['profile_get_voice'],
                    'voice_preview_url' => $input['audio_url'],
                    'first_message' => $input['first_message'],
                    'system_prompt' => $input['system_prompt'],
                    'system_instruction' => $input['system_instruction'],
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
                  CURLOPT_POSTFIELDS =>'{
                    "name": "'.$input['profile_name'].'",
                    "system_prompt": "'.$input['system_prompt'].'",
                    "system_instruction": "'.$input['system_instruction'].'",
                    "voice_name": "'.$input['profile_get_voice'].'",
                    "voice_model": "eleven_multilingual_v2",
                    "voice_settings": {
                        "stability": 0.5,
                        "similarity_boost": 0.75,
                        "style": 0,
                        "use_speaker_boost": true
                    },
                    "short_description": "'.$input['profile_body_description'].'",
                    "first_message": "'.$input['first_message'].'"
                }',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Basic '.env('AI_CHATUSER_APIKEY')
                  ),
                ));
                $response = curl_exec($curl);

                // print_r($response);
                // die;
                $responseArray = json_decode($response, true);

                if (isset($responseArray['data']['persona_id'])) {
                    $personaId = $responseArray['data']['persona_id'];
                } else {
                    echo "Persona ID not found in the response.";
                }
                
            $profile = new Profile;
            $profile->name = $input['profile_name'];
            $profile->ethnicity = $input['profile_ethnicity'];
            $profile->personality = $input['profile_personality'];
            $profile->age = $input['profile_age'];
            $profile->gender = $input['profile_gender'];
            $profile->occupation = $input['profile_occupation'];
            $profile->hobbies = $input['profile_hobbies'];
            $profile->relationship_status = $input['profile_relationship_status'];
            $profile->body_description = $input['profile_body_description'];
            $profile->description = $input['description'];
            $profile->voice_name = $input['profile_name'];
            $profile->voice_preview_url = $input['audio_url'];
            $profile->persona_id = $personaId;
            $profile->first_message = $input['first_message'];  
            $profile->system_prompt = $input['system_prompt'];
            $profile->system_instruction = $input['system_instruction'];
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