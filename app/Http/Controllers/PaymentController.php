<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscriptions;
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
        return view('front.payment.form', compact('product_id','amount'));
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
                "campaignId": "1",
                "offers": [
                    {
                        "offer_id": "2",
                        "product_id": '.$request->product_id.',
                        "billing_model_id": 4,
                        "quantity": 1
                    }
                ],
                "billingSameAsShipping": "YES",
                "shippingAddress1": "123 Test St",
                "shippingCity": "Palm Harbor",
                "shippingState": "FL",
                "shippingZip": "34684",
                "shippingCountry": "US",
                "forceGatewayId": "1",
                "preserve_force_gateway": "1"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic dmljZWFwcF8xMDExNDo1NDE4NTI5NWY0ZTkyYw=='
              ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response, true);
            // echo $response;
            if($response['response_code'] == 100)
            {

                $subscriptions = new Subscriptions;
                $subscriptions->user_id = session('user_id');
                $subscriptions->plan_id = $request->product_id;
                $subscriptions->order_id = $response['order_id'];   
                $subscriptions->transactionID = $response['transactionID'];
                $subscriptions->customerId = $response['customerId'];
                $subscriptions->authId = $response['authId'];
                $subscriptions->orderTotal = $response['orderTotal'];
                $subscriptions->product_id = $response['line_items'][0]['product_id'];
                $subscriptions->quantity = $response['line_items'][0]['quantity'];
                $subscriptions->subscription_id = $response['line_items'][0]['subscription_id'];
                $subscriptions->subscription_start_date = date('Y-m-d');
                $subscriptions->subscription_end_date = date('Y-m-d', strtotime(date('Y-m-d') . ' +30 days'));
                $subscriptions->subscription_next_date = date('Y-m-d', strtotime(date('Y-m-d') . ' +30 days'));
                $subscriptions->save(); // Save the profile data

                $usercredit = Managecredit::where('user_id', $user->id)->first();
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
                        $newTotalCredit = $usercredit->totalcredit + 2500;
                        $currentcredit = $usercredit->currentcredit + 2500;
                        $usercredit->update(['totalcredit' => $newTotalCredit,'currentcredit' => $currentcredit]);
                    }      
                }

                

                return redirect()->route('profile.index')->withSuccess('subscription done');
            }elseif($response['response_code'] == 10800)
            {
                $subscriptions = new Subscriptions;
                $subscriptions->user_id = session('user_id');
                $subscriptions->plan_id = $request->product_id;
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
