<?php

namespace App\Interfaces;

use App\DataTransferObjects\PaymentDto;
use App\Enums\WebhookEvent;
use Illuminate\Http\Client\Response;

interface PaymentInterface
{
    public function initializeTransaction(PaymentDto $paymentDto): Response;

    public function handleWebhook(array $payload): WebhookEvent;
}
