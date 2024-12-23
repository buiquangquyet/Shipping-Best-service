<?php

namespace App\Api\V1\Services\LogService;
class LogCommon
{
    // *********** Source Request From *********** //
    const REQUEST_FROM = [
        'PARTNER' => 'request_from_partner',
        'CMS' => 'request_from_cms',
    ];

// *********** Type action *********** //
    const ACTION = [
        'CREATE_ORDER' => 'create_order',
        'WEBHOOK' => 'webhook',
    ];

// *********** Type response *********** //
    const TYPE_RESPONSE_TO = [
        'PARTNER' => 'response_to_partner',
        'BEST' => 'response_to_best',
    ];

    const KEY_QUEUE_LOG = 'queue-log';

    public static function randomLogMongoCode($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}


