<?php

namespace App\Enums;

enum WebhookEvent: string
{
    case CHARGE_SUCCESS = "charge.success";
    case CHARGE_FAILED = "charge.failed";
}
