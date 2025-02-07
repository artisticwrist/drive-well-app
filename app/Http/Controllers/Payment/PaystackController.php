<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\User;  
use App\Models\Transactions; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaystackController extends Controller
{
    //
    public function make_payment(Request $request){

        $request->validate([
            'email' => 'required|email',
            'amount' => 'required',
            'hours' => 'required|integer',
            'course_id' => 'nullable|integer',
            'duration' => 'required|string'
        ]);
        
        $formData = [
            'email' => $request->email,
            'amount' => $request->amount,
            'hours' => $request->hours,
            'course_id' => $request->course_id,
            'duration' => $request->duration,
            'callback_url' => route('callback') 
        ];
    
        $pay = json_decode($this->initialize_payment($formData));
    
        if ($pay && isset($pay->status) && isset($pay->data->authorization_url)) {
            return response()->json([
                'success' => true,
                'authorization_url' => $pay->data->authorization_url
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Something went wrong with the payment initialization."
            ], 401);
        }
        
    }
    

    public function initialize_payment($formData){
        $url ="https://api.paystack.co/transaction/initialize";
        $fields_string = http_build_query($formData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . env("PAYSTACK_SECRET_KEY"),
            "Cache-Control: no-cache"
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function payment_callback()
    {
        $response = json_decode($this->verify_payment(request('reference')));
    
        $email = request('email');
        $hours = request('hours');
        $reference = request('reference');
        $amount = request('amount');
    
        if ($response && isset($response->status) && $response->status) {
    
            $tx_ref = "drivewell-" . $reference;
    
            $data = [
                'email' => $email,
                'hours' => $hours,
                'reference' => $tx_ref,
                'amount' => $amount
            ];
    
            // Send emails
            Mail::to($email)->send(new \App\Mail\PaymentUser($data));
            Mail::to('contactdev.bigjoe@gmail.com')->send(new \App\Mail\PaymentNotice($data));
    
            // Record transaction
            $transaction = Transactions::create([
                'email' => $email,
                'hours' => $hours,
                'tx_ref' => $tx_ref,
                'amount' => $amount,
                'payment_status' => 'success'
            ]);
    
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->subscription_status = true;
                $user->save();
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Payment Success',
                'transaction' => $transaction,
                'user' => $user
            ], 200);
    
        } else {
            return response()->json([
                'success' => false,
                'message' => $response->message ?? 'Invalid reference.'
            ], 401);
        }
    }

    public function verify_payment($reference)
    {
        $curl = curl_init();
    
        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . env("PAYSTACK_SECRET_KEY"),
                "Cache-Control: no-cache"
            )
        ));
    
        // Execute the cURL request
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); // Get the HTTP status code
        $err = curl_error($curl); // Capture cURL error if any
        curl_close($curl);
    
        // Check if there was a cURL error
        if ($err) {
            Log::error("cURL Error: " . $err); // Log the error for debugging
            return json_encode(['status' => false, 'message' => 'cURL Error: ' . $err]);
        }
    
        // Check if the response code is valid (200-299 are success codes)
        if ($httpCode < 200 || $httpCode >= 300) {
            Log::error("HTTP Error: " . $httpCode . " Response: " . $response); // Log HTTP errors for debugging
            return json_encode(['status' => false, 'message' => 'Payment verification failed. HTTP code: ' . $httpCode]);
        }
    
        // Decode the response to JSON
        $responseData = json_decode($response);
    
        // Check if the response is valid and contains status
        if (isset($responseData->status) && $responseData->status) {
            Log::info('Payment Verified: ', (array) $responseData); // Log successful payment verification
            return $response; // Return the original response if payment is successful
        } else {
            Log::error("Payment verification failed: ", (array) $responseData); // Log the failure response
            return json_encode(['status' => false, 'message' => 'Payment verification failed.']);
        }
    }
    


}
 
