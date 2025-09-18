<?php

return [
    'env' => env('MPESA_ENV', 'sandbox'), // sandbox | production
    'api_key' => env('MPESA_API_KEY'),
    'public_key' => env('MPESA_PUBLIC_KEY'),
    'origin' => env('MPESA_ORIGIN', '*'),
    'service_provider_code' => env('MPESA_SERVICE_PROVIDER_CODE'),
    'country' => env('MPESA_COUNTRY', 'TZN'),
    'currency' => env('MPESA_CURRENCY', 'TZS'),

    'urls' => [
        'sandbox' => [
            'session' => 'https://openapi.m-pesa.com/sandbox/ipg/v2/vodacomTZN/getSession/',
            'c2b' => 'https://openapi.m-pesa.com/sandbox/ipg/v2/vodacomTZN/c2bPayment/singleStage/',
            'status' => 'https://openapi.m-pesa.com/sandbox/ipg/v2/vodacomTZN/queryTransactionStatus/',
        ],
        'production' => [
            'session' => 'https://openapi.m-pesa.com/openapi/ipg/v2/vodacomTZN/getSession/',
            'c2b' => 'https://openapi.m-pesa.com/openapi/ipg/v2/vodacomTZN/c2bPayment/singleStage/',
            'status' => 'https://openapi.m-pesa.com/openapi/ipg/v2/vodacomTZN/queryTransactionStatus/',
        ],
    ],
];
