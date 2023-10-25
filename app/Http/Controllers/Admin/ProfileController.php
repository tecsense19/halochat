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
  
       return view('admin.profiles.addedit');
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
        return view('admin.profiles.addedit', compact('profileList', 'id'));
    }

    public function store(Request $request)
    {
        try {
        $input = $request->all();

        $validator = Validator::make($input, [
            'profile_name' => 'required|string',
            'profile_ethnicity' => 'required|string',
            'profile_personality' => 'required|string',
            'profile_age' => 'required|integer',
            'profile_gender' => 'required|string',
            'profile_occupation' => 'required|string',
            'profile_hobbies' => 'required|string',
            'profile_relationship_status' => 'required|string',
            'profile_body_description' => 'required|string',
            'profile_description' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('admin.profile')->withErrors($validator);
            //return redirect()->route('admin.profile.addProfiles')->withErrors($validator)->withInput();
        }
        else {
            $profile_update = Profile::where('profile_id',$input['profile_id'])->first();
            if($profile_update)
            {
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
                    'description' => $input['profile_description'],
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
            $profile->description = $input['profile_description'];
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
        return view('admin.profiles.list', compact('profileList'));
       
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