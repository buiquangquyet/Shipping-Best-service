<?php

namespace App\Api\V1\Controllers;

use App\Api\Traits\ApiTrait;
use App\Api\V1\Requests\CancelOrderRequest;
use App\Api\V1\Requests\GetOrderRequest;
use App\Api\V1\Services\DeliveryService\OrderService;

class OrderController
{
    use ApiTrait;
    public function __construct(private readonly OrderService $orderService){}
    public function createOrder()
    {
    }

    public function getOrder(GetOrderRequest $request)
    {
        try {
            $data = $request->only('LangType', 'Codes', 'headers');
            $response = $this->orderService->getOrder($data);
            return $this->responseSuccess($response, true);
        }catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }

    }

    public function cancelOrder(CancelOrderRequest $request)
    {
        try {
            $data = $request->only('Code', 'headers');
            $response = $this->orderService->cancelOrder($data);
            return $this->responseSuccess($response, true);
        }catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
}
