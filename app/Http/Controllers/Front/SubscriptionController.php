<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Managecredit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SubscriptionController extends Controller
{

    public function index()
    {

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        // CURLOPT_URL => 'https://viceapp.sticky.io/api/v2/products',
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => '',
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => 'GET',
        // CURLOPT_HTTPHEADER => array(
        //     'Authorization: Basic dmljZWFwcF8xMDExNDo1NDE4NTI5NWY0ZTkyYw=='
        // ),
        // ));
        // $response = curl_exec($curl);
        // curl_close($curl);
        // $response = json_decode($response, true);
        return view("front.subscription.subscription",  compact('response'));
    }

}