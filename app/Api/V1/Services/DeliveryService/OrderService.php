<?php

namespace App\Api\V1\Services\DeliveryService;

use App\Api\V1\Base\BaseService;

class OrderService extends BaseService
{
    public function __construct()
    {
        $this->baseUrl = env('BEST_API_URL',  DeliveryCommon::MASTER_URL);
        $this->fileCommon = 'DeliveryCommon';
        $this->servicePath = 'app\Api\V1\Services\DeliveryService';
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    public function getOrder(array $data): mixed
    {
        $uri = $this->getUri('getOrder');
        $method = $this->getMethod('getOrder');
        $options['headers'] = $data['headers'] ?? [];
        unset($data['headers']);
        $options['json'] = $data;
        return $this->doRequest($method, $uri, $options);
    }

    public function cancelOrder(array $data): mixed
    {
        $uri = $this->getUri('cancelOrder');
        $method = $this->getMethod('cancelOrder');
        $options['headers'] = $data['headers'] ?? [];
        unset($data['headers']);
        $options['json'] = $data;
        return $this->doRequest($method, $uri, $options);
    }
}
