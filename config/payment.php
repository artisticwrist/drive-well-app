<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment Configurations
    |--------------------------------------------------------------------------
    |
    | This option all the payment configurations in the application
    |
    */

    'paystack' => [
        'url' => env('PAYSTACK_URL'),
        'secret' => env('PAYSTACK_SECRET'),
    ],


];
