<?php

namespace App\Api\V1\Services\LogService\LogCreateOrder;
use App\Api\Base\LogBaseService;
use App\Mongo\LogBillLading;
use Exception;

class LogCreateOrderService extends LogBaseService
{
    public function __construct()
    {
        $this->servicePath = '\App\Api\V1\Services\LogService\LogCreateOrder';
    }

    public function insert($data)
    {
        try {
            $dataTransform = $this->_transformData('InsertDataTransform', ['dataRequest' => $data]);
            LogBillLading::insert($dataTransform);
        } catch (\Exception $exception) {
            throw new Exception(__($exception->getMessage()));
        }
    }


}
