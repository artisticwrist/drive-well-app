<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'hours',
        'course_id',
        'price',
        'payment_status',
        'course_status',
        'tx_ref'
    ];
}
