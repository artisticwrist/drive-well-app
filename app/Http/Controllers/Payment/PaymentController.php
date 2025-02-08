<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $paymentService)
    {

    }
    public function handleWebhook(Request $request)
    {
        $signature = $request->header('X_PAYSTACK_SIGNATURE');
        $payload = $request->getContent();
        Log::info(json_encode($payload), ['webhook handling']);
        if (!$signature || !$this->isValidSignature($payload, $signature)) {
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        $isHandled = $this->paymentService->handleWebhook($payload);
        if ($isHandled)
        {
            return response();
        }

    }

    private function isValidSignature($payload, $signature)
    {
        return hash_hmac('sha512', $payload, config('payment.paystack.secret')) === $signature;
    }


}
