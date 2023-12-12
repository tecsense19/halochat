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
    public function subscription(Request $request)
    {
        if(!session()->has('authenticated_admin')){
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to access the dashboard.'])->onlyInput('email');
        }
        try{
            return view('admin.subscription.subscription');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function subscriptionList(Request $request)
    {
        $input = $request->all();

        $search = $input['search'];

        // $usersList = User::with('credit')->where('role', 'User')
        //                 ->when($search, function ($query) use ($search) {
        //                     return $query->where(function ($query) use ($search) {
        //                         $query->where('name', 'like', '%' . $search . '%')
        //                             ->orWhere('email', 'like', '%' . $search . '%');
        //                     });
        //                 })
        //                 ->paginate(10);
        $subscriptionList = Subscriptions::with('subscription_user')->orderBy('id','DESC')->when($search, function ($query) use ($search) {
                            return $query->where(function ($query) use ($search) {
                                $query->where('status', 'like', '%' . $search . '%')
                                    ->orWhere('subscription_id', 'like', '%' . $search . '%');
                            });
                        })
                        ->paginate(10);
                        

        return view('admin.subscription.list', compact('subscriptionList'));
    }
}