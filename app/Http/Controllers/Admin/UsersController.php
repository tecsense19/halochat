<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usedcredites;
use App\Models\Managecredit;
use App\Models\Landerpage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function users(Request $request)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
        try{
            return view('admin.users.users');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function listUser(Request $request)
    {
        $input = $request->all();

        $search = $input['search'];

        $usersList = User::with('credit')->where('role', 'User')
                        ->when($search, function ($query) use ($search) {
                            return $query->where(function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%')
                                    ->orWhere('email', 'like', '%' . $search . '%');
                            });
                        })
                        ->paginate(10);

        return view('admin.users.list', compact('usersList'));
    }


    public function usedCreditDebit(Request $request, $userId)
    {
        try{
            if(!session()->has('authenticated_admin')){
                return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
            }

            $userId = Crypt::decryptString($userId);

            $checkUser = User::where('id', $userId)->first();
            if($checkUser)
            {
                $totalCredit = Usedcredites::where('user_id', $userId)->sum('credit');
                $totalDebit = Usedcredites::where('user_id', $userId)->sum('debit');
                return view('admin.users.usedcredit', compact('userId', 'totalCredit', 'totalDebit'));
            }
            else
            {
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function usedCreditDebitList(Request $request)
    {
        $input = $request->all();

        $search = $input['search'];
        $user_id = $input['user_id'];

        $credit_debit = Usedcredites::with('creditdebit')->where('user_id', $user_id)->paginate(10);

        return view('admin.users.usercreditlist' , compact('credit_debit'));
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
            if(!session()->has('authenticated_admin')){
                return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
            }
            $landerdata = Landerpage::get();
            return view('admin.lander.add')->with('landerdata' , $landerdata);;
        }

        public function addLanderpagedata(Request $request)
        {
            if(!session()->has('authenticated_admin')){
                return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
            }

            $input = $request->all();
         
    
            try {
            
                $validator = Validator::make($input, [
                    // 'halochat_logo' => 'required',
                    // 'sign_up_now_text' => 'required',
                    // 'sign_up_now_link' => 'required', // Example validation for a URL
                    // 'Introducing_text' => 'required',
                    // 'pioneering_text' => 'required',
                    // 'discover_more' => 'required',
                    // 'discover_more_link' => 'required',
                    // 'lets_talk_img' => 'required', // Adjust as needed for image validation
                    // 'welcome_heading' => 'required',
                    // 'welcome_sub_text' => 'required',
                    // 'welcome_lady_img' => 'required',
                ]);
          
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                    //return redirect()->route('admin.profile.addProfiles')->withErrors($validator)->withInput();
                }
                else {
                
                    $landerpage_update = Landerpage::where('id',$input['id'])->first();

                    if($landerpage_update)
                    {
                        $landerpage_update = Landerpage::where('id', $input['id'])->update([
                            
                            'halochat_logo' => isset($input['halochat_logo']) ? $input['halochat_logo'] : '',
                            'sign_up_now_text' => isset($input['sign_up_now_text']) ? $input['sign_up_now_text'] : '',
                            'sign_up_now_link' => isset($input['sign_up_now_link']) ? $input['sign_up_now_link'] : '',
                            'Introducing_text' => isset($input['Introducing_text']) ? $input['Introducing_text'] : '',
                            'pioneering_text' => isset($input['pioneering_text']) ? $input['pioneering_text'] : '',
                            'discover_more' => isset($input['discover_more']) ? $input['discover_more'] : '',
                            'discover_more_link' => isset($input['discover_more_link']) ? $input['discover_more_link'] : '',
                            'lets_talk_img' => isset($input['lets_talk_img']) ? $input['lets_talk_img'] : '',
                            'welcome_heading' => isset($input['welcome_heading']) ? $input['welcome_heading'] : '',
                            'welcome_sub_text' => isset($input['welcome_sub_text']) ? $input['welcome_sub_text'] : '',
                            'welcome_lady_img' => isset($input['welcome_lady_img']) ? $input['welcome_lady_img'] : '',
                            'features_heading' => isset($input['features_heading']) ? $input['features_heading'] : '',
                            'features_sub_text' => isset($input['features_sub_text']) ? $input['features_sub_text'] : '',
                            'explore_btn_text' => isset($input['explore_btn_text']) ? $input['explore_btn_text'] : '',
                            'explore_btn_link' => isset($input['explore_btn_link']) ? $input['explore_btn_link'] : '',
                            'meet_your_heading' => isset($input['meet_your_heading']) ? $input['meet_your_heading'] : '',
                            'meet_your_sub_text' => isset($input['meet_your_sub_text']) ? $input['meet_your_sub_text'] : '',
                            'meet_your_img' => isset($input['meet_your_img']) ? $input['meet_your_img'] : '',
                            'enhanced_features_heading' => isset($input['enhanced_features_heading']) ? $input['enhanced_features_heading'] : '',
                            'enhanced_features_sub_text' => isset($input['enhanced_features_sub_text']) ? $input['enhanced_features_sub_text'] : '',
                            'cta_title_text' => isset($input['cta_title_text']) ? $input['cta_title_text'] : '',
                            'cta_sub_text' => isset($input['cta_sub_text']) ? $input['cta_sub_text'] : '',
                            'cta_lady_img' => isset($input['cta_lady_img']) ? $input['cta_lady_img'] : '',
                            'customer_feedback' => isset($input['customer_feedback']) ? $input['customer_feedback'] : '',
                            'privacy_policy_text' => isset($input['privacy_policy_text']) ? $input['privacy_policy_text'] : '',
                            'terms_conditions_text' => isset($input['terms_conditions_text']) ? $input['terms_conditions_text'] : '',
                            'terms_conditions_link' => isset($input['terms_conditions_link']) ? $input['terms_conditions_link'] : '',
                            'revolution_text' => isset($input['revolution_text']) ? $input['revolution_text'] : '',
                        ]);
                    }
                    return redirect()->back();
                }     
            }
            catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
    
}