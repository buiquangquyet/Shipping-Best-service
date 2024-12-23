<?php

namespace App\Api\V1\Services\DeliveryService;

class DeliveryCommon
{
    const MASTER_URL = 'http://sgp-seaedi.800best.com';
    const LIST_URI = [
        'login' => [
            'uri' => '/VietNamV3/v3/api/process/sears/User/Login',
            'method' => 'POST'
        ],
        'getOrder' => [
            'uri' => '/VietNamV3/v3/api/process/sears/Order/Query',
            'method' => 'POST'
        ],
        'cancelOrder' => [
            'uri' => '/VietNamV3/v3/api/process/sears/Order/Cancel',
            'method' => 'POST'
        ]
    ];
}
