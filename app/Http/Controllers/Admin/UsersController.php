<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usedcredites;
use App\Models\Managecredit;
use App\Models\Landerpage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function users()
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
        try{
            $usersList = User::with('credit')->where('role', 'User')->paginate(6);
            return view('admin.users.list' , compact('usersList'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function used_credit_debit(Request $request)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
        $url = $request->url();
        $segments = explode('/', rtrim($url, '/'));
        // Get the last segment (ID)
        $lastId = end($segments);
        try{
            $credit_debit = Usedcredites::with('creditdebit')->where('user_id', $lastId)->paginate(100);
            return view('admin.users.usedcredit' , compact('credit_debit'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function sell_report(Request $request)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }

        try{
            $credit_debit = Usedcredites::with('creditdebit')->where('payment_id', '!=', null)->paginate(100);
            return view('admin.sale_report.sale' , compact('credit_debit'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function addUsers(Request $request)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
    //$get_voice = $this->get_voice();
       return view('admin.users.addedit');
    }
    
    public function edit($id)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
        $userList = User::with('credit')->where('id', $id)->first();
        return view('admin.users.addedit', compact('userList', 'id'));
    }

    public function store(Request $request)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }

        try {
            $input = $request->all();
    
            $validator = Validator::make($input, [
                'name' => 'required|string',
                'email' => 'required|string',
                'gender' => 'required|string',
                'chatuser_id' => 'required|string',
                'role' => 'required|string',
                'plans' => 'required|string',
                'status' => 'required|string',
            ]);
            
            if ($validator->fails()) {
    
                return redirect()->back()->withErrors($validator);
                //return redirect()->route('admin.profile.addProfiles')->withErrors($validator)->withInput();
            }
            else {
    
                $user_update = User::where('id',$input['id'])->first();
                if($user_update)
                {
                    $user_update = User::where('id', $input['id'])->update([
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'gender' => $input['gender'],
                        'google_id' => $input['google_id'],
                        'chatuser_id' => $input['chatuser_id'],
                        'role' => $input['role'],
                        'plans' => $input['plans'],
                        'status' => $input['status'],
                        'contact_us' => $input['contact_us'],
                    ]);

                    $user_update = Managecredit::where('user_id', $input['id'])->update([
                        'totalcredit' => $input['totalcredit'],
                        'updated_at' => now(),
                    ]);
                 
                }
            }     
        }
        catch (\Exception $e) {
        dd($e->getMessage());
        }
            $userList = User::with('credit')->where('role', 'User')->get();
            return redirect()->route('admin.users')->with('userList' , $userList);
           
        }


        public function suspend($id)
        {
            if(!session()->has('authenticated_admin')){
                return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
            }
            // Find the resource you want to delete
            $user = User::where('id', $id)->first();
            // Check if the resource exists
            if (!$user) {
                return redirect()->route('admin.users')->with('error', 'user not found');
            }
            // Perform the deletion
            $profile = User::where('id', $id)->update([ 'status' => 'Suspend']);
            return true;
        }


        public function active($id)
        {
            if(!session()->has('authenticated_admin')){
                return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
            }
            // Find the resource you want to delete
            $user = User::where('id', $id)->first();
            // Check if the resource exists
            if (!$user) {
                return redirect()->route('admin.users')->with('error', 'user not found');
            }
            // Perform the deletion
            $profile = User::where('id', $id)->update([ 'status' => 'Active']);
            return true;
        }

        public function landerpage(Request $request)
        {
            $landerdata = Landerpage::get();
            return view('admin.lander.add')->with('landerdata' , $landerdata);;
        }

        public function addLanderpagedata(Request $request)
        {
            if(!session()->has('authenticated_admin')){
                return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
            }

            $input = $request->all();
            // dd($input);
            // die;
    
            try {
            
                $validator = Validator::make($input, [
                    // 'halochat_logo' => 'required|string',
                    // 'sign_up_now_text' => 'required|string',
                    // 'sign_up_now_link' => 'required|string|url', // Example validation for a URL
                    // 'Introducing_text' => 'required|string',
                    // 'pioneering_text' => 'required|string',
                    'discover_more' => 'required|string',
                    // 'discover_more_link' => 'required|string|url',
                    // 'lets_talk_img' => 'required|string', // Adjust as needed for image validation
                    // 'welcome_heading' => 'required|string',
                    // 'welcome_sub_text' => 'required|string',
                    // 'welcome_lady_img' => 'required|string',
                ]);
                
                if ($validator->fails()) {
        
                    return redirect()->back()->withErrors($validator);
                    //return redirect()->route('admin.profile.addProfiles')->withErrors($validator)->withInput();
                }
                else {
        
                    $user_update = Landerpage::where('id',$input['id'])->first();
                    if($user_update)
                    {
                        $user_update = User::where('id', $input['id'])->update([
                            'halochat_logo' => $input['halochat_logo'],
                            'sign_up_now_text' => $input['sign_up_now_text'],
                            'sign_up_now_link' => $input['sign_up_now_link'],
                            'Introducing_text' => $input['Introducing_text'],
                            'pioneering_text' => $input['pioneering_text'],
                            'discover_more' => $input['discover_more'],
                            'discover_more_link' => $input['discover_more_link'],
                            'lets_talk_img' => $input['lets_talk_img'],
                            'welcome_heading' => $input['welcome_heading'],
                        ]);
    
                        $user_update = Managecredit::where('user_id', $input['id'])->update([
                            'totalcredit' => $input['totalcredit'],
                            'updated_at' => now(),
                        ]);
                     
                    }
                }     
            }
            catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
    
}
