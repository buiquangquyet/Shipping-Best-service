<?php

namespace App\Api\Base;

use App\Api\V1\Services\LogService\LogCommon;
use App\Api\V1\Services\LogService\LogCreateOrder\LogCreateOrderService;
use App\Api\V1\Services\LogService\LogWebhook\LogWebhookService;

class LogServiceFactory
{
    public static function create($action)
    {
        switch ($action) {
            case LogCommon::ACTION['CREATE_ORDER'];
                return new LogCreateOrderService();
            case LogCommon::ACTION['WEBHOOK'];
                return new LogWebhookService();
            default:
                return null;
        }
    }
}
