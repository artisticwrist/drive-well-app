<?php

namespace App\Services;

use App\DataTransferObjects\PaymentDto;
use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use App\Enums\WebhookEvent;
use App\Interfaces\PaymentInterface;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentService
{
    public function __construct(protected PaystackService $paymentProvider) {}
    public function createPayment(PaymentDto $paymentDto)
    {
        $response = $this->paymentProvider->initializeTransaction($paymentDto)->json();
        $payment = Payment::create([
            'reference' => $response['data']['reference'],
            'amount' => $paymentDto->amount,
            'method' => "paystack",
            'status' => PaymentStatus::PENDING,
            'authorization_url' => $response['data']['authorization_url'],
            'access_code' => $response['data']['access_code']
        ]);
        return $payment;
    }

    protected function initializePaystackTransaction($paymentDto)
    {

    }

    public function handleWebhook($payload): bool
    {
        $payload = json_decode($payload, true);
        $webhookEvent = $this->paymentProvider->handleWebhook($payload);
        $webhookHandled =  match ($webhookEvent) {
            WebhookEvent::CHARGE_SUCCESS => $this->handleSuccessCharge($payload),
            WebhookEvent::CHARGE_FAILED => $this->handleFailedCharge()
        };
        return $webhookHandled;
    }

    protected function handleSuccessCharge($payload): bool
    {
        $reference = $payload['data']['reference'];
        $payment = Payment::where('reference', $reference)->firstOrFail();
        if ($payment->status !== PaymentStatus::PAID)
        {
            try {
                DB::transaction(function () use($payment) {
                    $payment->update([
                        'status' => PaymentStatus::PAID
                    ]);
                    $payment->booking->update([
                        'status' => BookingStatus::CONFIRMED
                    ]);
                });
                DB::afterCommit(function () use ($payment) {
                    $user = $payment->booking->user;
                    $data = [
                        'email' => $user->email,
                        'reference' => $payment->reference,
                        'amount' => $payment->amount,
                        'duration' => $payment->booking->duration
                    ];
                    Mail::to($user)->send(new \App\Mail\PaymentUser($data));
                    Mail::to('contactdev.bigjoe@gmail.com')->send(new \App\Mail\PaymentNotice($data));
                });
            } catch (\Throwable $th) {
                Log::error($th->getMessage(), ['Handling Success Charge, Webhook']);
                throw new \Exception("unable to successfully implement payment verification");
            }
        }
        return true;
    }

    protected function handleFailedCharge(): bool
    {
        return true;
    }
}
