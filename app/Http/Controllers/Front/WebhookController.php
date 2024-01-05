<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function webhook(Request $request)
    {
        $webhookData = file_get_contents('php://input');
        
        // Decode JSON data
        $decodedData = json_decode($webhookData, true);
        
        if ($decodedData) {
            // Append the raw webhook data to a text file
            file_put_contents('webhook_data.txt', $webhookData . "\n\n", FILE_APPEND);
        
            // Respond to the webhook request (optional)
            http_response_code(200);
            echo "Webhook data received and stored.";
        } else {
            // Respond with an error if the JSON data couldn't be decoded
            http_response_code(400);
            echo "Error decoding JSON data.";
        }

    }

    public function webhookSubscription(Request $request)
    {
        $webhookData = file_get_contents('php://input');
        
        // Decode JSON data
        $decodedData = json_decode($webhookData, true);
        
        if ($decodedData) {
            // Append the raw webhook data to a text file
            file_put_contents('webhookSubscription.txt', $webhookData . "\n\n", FILE_APPEND);
        
            // Respond to the webhook request (optional)
            http_response_code(200);
            echo "Webhook data received and stored.";
        } else {
            // Respond with an error if the JSON data couldn't be decoded
            http_response_code(400);
            echo "Error decoding JSON data.";
        }

    }

}