<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference' => $this->reference,
            'amount' => $this->amount,
            'method' => $this->method,
            'status' => $this->status->value,
            'gateway_response' => $this->gateway_response,
            'authorization_url' => $this->authorization_url,
            'access_code' => $this->access_code,
        ];
    }
}
