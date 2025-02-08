<?php

namespace App\DataTransferObjects;

use App\Http\Requests\StoreBookingRequest;

readonly class PaymentDto
{
    public function __construct(
        public string $email,
        public int $amount,
        public ?string $reference,
    ) {}

}
