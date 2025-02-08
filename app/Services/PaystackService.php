<?php

namespace App\Services;

use App\DataTransferObjects\PaymentDto;
use App\Enums\PaymentStatus;
use App\Enums\PaystackEvent;
use App\Enums\WebhookEvent;
use App\Exceptions\PaymentGatewayException;
use App\Interfaces\PaymentInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackService implements PaymentInterface
{
    protected $baseUrl;
    protected $secret;

    public function __construct()
    {
        $this->baseUrl = config('payment.paystack.url');
        $this->secret = config('payment.paystack.secret');
    }

    public function startHttp()
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])
        ->withToken($this->secret)
        ->baseUrl($this->baseUrl);
    }

    public function initializeTransaction(PaymentDto $paymentDto): Response
    {
        try {
            $response =  $this->startHttp()
                ->post(
                    '/transaction/initialize',
                    [
                        'amount' => $paymentDto->amount * 100,
                        'email' => $paymentDto->email,
                        'reference' => $paymentDto->reference
                    ]
                );
            if (!$response->successful() || $response['status'] === false)
            {
                throw new \Exception('Unable to initialize payment. Please try again or contact admin');
            }
        } catch (\Throwable $th)
        {
            Log::info(
                $th->getMessage(),
                [
                    'Paystack Transaction Initialization',
                    "payment_dto" => json_encode($paymentDto)
                ]
            );
            throw new PaymentGatewayException('Unable to connect to payment gateway');
        }

        return $response;
    }


    public function handleWebhook($payload): WebhookEvent
    {
        $webhookEvent =  match($payload['event']) {
            "charge.success" => WebhookEvent::CHARGE_SUCCESS,
            'charge.failed' => WebhookEvent::CHARGE_FAILED,
            default => throw new PaymentGatewayException("Unhandled webhook event")
        };
        if ($webhookEvent === WebhookEvent::CHARGE_SUCCESS && ($payload['data']['status'] !== "success"))
        {
            throw new \Exception("Transaction has not been paid for and charge success webhook was sent");
        }

        return $webhookEvent;
    }

}
