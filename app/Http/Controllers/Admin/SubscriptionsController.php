<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SubscriptionsController extends Controller
{
    public function subscription(Request $request, $userId)
    {
        try{
            if(!session()->has('authenticated_admin')){
                return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
            }

            $userId = Crypt::decryptString($userId);

            return view('admin.subscription.subscription', compact('userId'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function subscriptionList(Request $request)
    {
        $input = $request->all();

        $search = $input['search'];
        $user_id = $input['user_id'];

        // $usersList = User::with('credit')->where('role', 'User')
        //                 ->when($search, function ($query) use ($search) {
        //                     return $query->where(function ($query) use ($search) {
        //                         $query->where('name', 'like', '%' . $search . '%')
        //                             ->orWhere('email', 'like', '%' . $search . '%');
        //                     });
        //                 })
        //                 ->paginate(10);

        $subscriptionList = Subscriptions::with('subscription_user')->where('user_id', $user_id)->orderBy('id','DESC')->when($search, function ($query) use ($search) {
                            return $query->where(function ($query) use ($search) {
                                $query->where('status', 'like', '%' . $search . '%')
                                    ->orWhere('subscription_id', 'like', '%' . $search . '%');
                            });
                        })
                        ->paginate(10);
                        

        return view('admin.subscription.list', compact('subscriptionList'));
    }
    public function subscriptionCancel(Request $request)
    {
        $input = $request->all();
        $user_id = $input['user_id'];
        $subscriptionsUser = Subscriptions::where('user_id', $user_id)->first();
        if($subscriptionsUser->status == "stop"){
                $param1 = "start"; 
        }else{
            $param1 = "stop"; 
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => env('STICKYIO_URLV2').'/subscriptions'.'/'.$subscriptionsUser->subscription_id.'/'.$param1,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic '.env('STICKYIO_KEY'),
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        if($subscriptionsUser->status == "stop"){
            Subscriptions::where('subscription_id', $subscriptionsUser->subscription_id)->update([
                'status' => "start",
            ]);
            return response()->json(['success' => true, 'message' => 'subscription start']);
           
        }else{
             Subscriptions::where('subscription_id', $subscriptionsUser->subscription_id)->update([
                'status' => "stop",
        ]);
        return response()->json(['success' => true, 'message' => 'subscription stoped']);
     
        } 
    }
}