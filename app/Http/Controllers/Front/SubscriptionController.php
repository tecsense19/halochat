<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Managecredit;
use App\Models\Subscriptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SubscriptionController extends Controller
{

    public function index()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('STICKYIO_URLV2').'/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.env('STICKYIO_KEY')
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        $subscriptionsUser = Subscriptions::where('user_id', session('user_id'))->first();
        return view("front.subscription.subscription",  compact('response', 'subscriptionsUser'));
    }

}