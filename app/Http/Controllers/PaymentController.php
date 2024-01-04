<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscriptions;
use App\Models\Subscriptions_history;
use App\Models\Managecredit;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    public function showForm(Request $request)
    {
        $product_id = $request->productid;
        $amount = $request->amount;
        $billing_model = $request->billing_model;
        $subscription_type = $request->subscription_type;

        return view('front.payment.form', compact('product_id','amount','billing_model','subscription_type'));
    }

    public function orderConfirm(Request $request)
    {

            $user = User::where('id', session('user_id'))->first();
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => env('STICKYIO_URL').'/new_order',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "firstName": "'.$user->name.'",
                "lastName": "Test",
                "currency": "USD",
                "billingFirstName": "LimeLight",
                "billingLastName": "Test",
                "billingAddress1": "123 Test St",
                "billingCity": "Palm Harbor",
                "billingState": "FL",
                "billingZip": "34684",
                "billingCountry": "US",
                "phone": "9876543210",
                "email": "'.$user->email.'",
                "creditCardType": "VISA",
                "creditCardNumber": "'.$request->cardNumber.'",
                "expirationDate": "'.str_replace('/', '', $request->expirationDate).'",
                "CVV": "'.$request->cvv.'",
                "shippingId": "2",
                "tranType": "Sale",
                "ipAddress": "2401:4900:1f3e:296:bcbc:2b68:ef62:b3fb",
                "campaignId": "2",
                "offers": [
                    {
                        "offer_id": "2",
                        "product_id": '.$request->product_id.',
                        "billing_model_id": "6",
                        "quantity": 1
                    }
                ],
                "billingSameAsShipping": "YES",
                "shippingAddress1": "123 Test St",
                "shippingCity": "Palm Harbor",
                "shippingState": "FL",
                "shippingZip": "34684",
                "shippingCountry": "US",
                "forceGatewayId": "3",
                "preserve_force_gateway": "3"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic '.env('STICKYIO_KEY'),
              ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response, true);
      
            if($response['response_code'] == 100)
            {

                $subscriptions = new Subscriptions;
                $subscriptions->user_id = session('user_id');
                $subscriptions->plan_id = $request->product_id;
                $subscriptions->order_id = $response['order_id'];   
                $subscriptions->transactionID = $response['transactionID'];
                $subscriptions->subscription_type = $request->subscription_type;
                $subscriptions->customerId = $response['customerId'];
                $subscriptions->authId = $response['authId'];
                $subscriptions->orderTotal = $response['orderTotal'];
                $subscriptions->product_id = $response['line_items'][0]['product_id'];
                $subscriptions->quantity = $response['line_items'][0]['quantity'];
                $subscriptions->subscription_id = $response['line_items'][0]['subscription_id'];
                $subscriptions->subscription_start_date = date('Y-m-d');
                $subscriptions->subscription_end_date = date('Y-m-d', strtotime(date('Y-m-d') . ' +30 days'));
                $subscriptions->subscription_next_date = date('Y-m-d', strtotime(date('Y-m-d') . ' +30 days'));
                $subscriptions->resp_msg = $response['resp_msg'];
                $subscriptions->save(); // Save the profile data

                $usercredit = Managecredit::where('user_id', $user->id)->first();

                if($request->product_id == 2)
                {
                    if ($usercredit) {
                        $newTotalCredit = $usercredit->totalcredit + 100;
                        $currentcredit = $usercredit->currentcredit + 100;
                        $usercredit->update(['totalcredit' => $newTotalCredit,'currentcredit' => $currentcredit]);
                    }     
                }

                if($request->product_id == 3)
                {
                    if ($usercredit) {
                        $newTotalCredit = $usercredit->totalcredit + 500;
                        $currentcredit = $usercredit->currentcredit + 500;
                        $usercredit->update(['totalcredit' => $newTotalCredit,'currentcredit' => $currentcredit]);
                    }     
                }

                if($request->product_id == 4)
                {
                    if ($usercredit) {
                        $newTotalCredit = $usercredit->totalcredit + 100;
                        $currentcredit = $usercredit->currentcredit + 100;
                        $usercredit->update(['totalcredit' => $newTotalCredit,'currentcredit' => $currentcredit]);
                    }     
                }

                if($request->product_id == 5)
                {
                    if ($usercredit) {
                        $newTotalCredit = $usercredit->totalcredit + 500;
                        $currentcredit = $usercredit->currentcredit + 500;
                        $usercredit->update(['totalcredit' => $newTotalCredit,'currentcredit' => $currentcredit]);
                    }      
                }

                if($request->product_id == 6)
                {
                    if ($usercredit) {
                        $newTotalCredit = $usercredit->totalcredit + 1000;
                        $currentcredit = $usercredit->currentcredit + 1000;
                        $usercredit->update(['totalcredit' => $newTotalCredit,'currentcredit' => $currentcredit]);
                    }      
                }

                

                return redirect()->route('profile.index')->withSuccess('subscription done');
            }elseif($response['response_code'] == 10800)
            {
                $subscriptions = new Subscriptions;
                $subscriptions->user_id = session('user_id');
                $subscriptions->plan_id = $request->product_id;
                $subscriptions->subscription_type = $request->subscription_type;
                $subscriptions->order_id = $response['order_id']; 
                $subscriptions->decline_reason = $response['decline_reason'];   
                $subscriptions->error_message = $response['error_message'];
                $subscriptions->status = $response['status'];
                $subscriptions->resp_msg = $response['resp_msg'];
                $subscriptions->authId = $response['authId'];
                $subscriptions->transactionID = $response['transId'];
                $subscriptions->save(); // Save the profile data

                return redirect()->route('profile.index')->withError('subscription not done, Reason:'.$response['resp_msg']);
            }else
            {
                return redirect()->route('profile.index')->withError('subscription not done');
            }

            
    }

    public function cancel(Request $request)
    {

            $subscriptionsUser = Subscriptions::where('user_id', session('user_id'))->first();
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
                return redirect()->route('profile.index')->withSuccess('subscription start');
           }else{
            Subscriptions::where('subscription_id', $subscriptionsUser->subscription_id)->update([
                'status' => "stop",
            ]);
            return redirect()->route('profile.index')->withSuccess('subscription stoped');
           }
         

            
    }

    public function cronOrderData()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://viceapp.sticky.io/api/v1/customer_view',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "customer_id":11
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic dmljZWFwcF8xMDExNDo1NDE4NTI5NWY0ZTkyYw=='
        ),
        ));

        $response1 = curl_exec($curl);

        curl_close($curl);
       
        $response1 = json_decode($response1, true);
        // print_r($response['order_list']);
        // Get the last value from the 'order_list' array
        $lastValue = end($response1['order_list']);
        // Print the result
        print_r($lastValue);
        
        $curl1 = curl_init();
        curl_setopt_array($curl1, array(
        CURLOPT_URL => 'https://viceapp.sticky.io/api/v1/order_view',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "order_id":[
                "'.$lastValue.'"
            ]
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic dmljZWFwcF8xMDExNDo1NDE4NTI5NWY0ZTkyYw=='
        ),
        ));

        $response = curl_exec($curl1);

        curl_close($curl);
        echo "<pre>";
        print_r( $response);
        $response = json_decode($response, true);
        $subscriptions_history = new Subscriptions_history;
        $subscriptions_history->user_id = session('user_id');
        $subscriptions_history->plan_id = $response['products'][0]['product_id'];
        $subscriptions_history->order_id = $response['order_id'];   
        $subscriptions_history->transactionID = $response['transaction_id'];
        $subscriptions_history->subscription_type = $response['products'][0]['name'];
        $subscriptions_history->customerId = $response['customer_id'];
        $subscriptions_history->authId = $response['auth_id'];
        $subscriptions_history->orderTotal = $response['order_total'];
        $subscriptions_history->product_id = $response['products'][0]['product_id'];
        $subscriptions_history->quantity = $response['main_product_quantity'];
        $subscriptions_history->subscription_id = $response['products'][0]['subscription_id'];
        $subscriptions_history->recurring_date = $response['products'][0]['recurring_date'];
        $subscriptions_history->subscription_start_date = date('Y-m-d');
        $subscriptions_history->subscription_end_date = date('Y-m-d', strtotime(date('Y-m-d') . ' +30 days'));
        $subscriptions_history->subscription_next_date = date('Y-m-d', strtotime(date('Y-m-d') . ' +30 days'));
        // $subscriptions_history->resp_msg = $response['resp_msg'];
        $subscriptions_history->save(); // Save the profile data

        die;
    }

    // public function makePayment(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     $token = $request->input('stripeToken');
    //     try {
    //     $charge = Charge::create([
    //         'amount' => 1000, // amount in cents
    //         'currency' => 'usd',
    //         'description' => 'Example charge',
    //         'source' => $token,
    //     ]);

    //     // Handle successful payment
    //     $this->sendConfirmationEmail(auth()->user(), $charge->id);
    //     return redirect('/')->with('success', 'Payment made successfully!');

    // } catch (\Stripe\Exception\CardException $e) {
    //     // Payment failed, handle the exception
    //     return redirect('/')->with('error', $e->getMessage());
    // }
    // }

    // private function sendConfirmationEmail($user, $paymentId)
    // {
    //     // Customize this function to send a confirmation email to the user
    //     // You may use Laravel's built-in Mail facade
    //     Mail::to($user->email)->send(new PaymentConfirmationMail($paymentId));
    // }
}
