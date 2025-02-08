<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING = "pending";
    case CONFIRMED = "confirmed";
    case USED = "used";
    case CANCELLED = "cancelled";
}
