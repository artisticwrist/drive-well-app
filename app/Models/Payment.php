<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts()
    {
        return [
            'status' => PaymentStatus::class
        ];
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'payment_id');
    }
}
