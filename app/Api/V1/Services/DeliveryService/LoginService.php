<?php

namespace App\Api\V1\Services\DeliveryService;

use App\Api\V1\Base\BaseService;

class LoginService extends BaseService
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
    public function login(array $data): mixed
    {
        $uri = $this->getUri('login');
        $method = $this->getMethod('login');
        $options['json'] = $data;
        return $this->doRequest($method, $uri, $options);
    }
}
