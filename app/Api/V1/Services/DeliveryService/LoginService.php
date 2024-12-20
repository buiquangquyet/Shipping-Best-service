<?php

namespace App\Api\V1\Services\DeliveryService;

use App\Api\V1\Base\BaseService;

class LoginService extends BaseService
{
    protected $baseUrl = DeliveryCommon::MASTER_URL;
    protected $fileCommon = 'DeliveryCommon';

    public function __construct()
    {
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

        return $this->doRequest($method, $uri, $data);
    }
}
