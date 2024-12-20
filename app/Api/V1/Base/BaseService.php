<?php

namespace App\Api\V1\Base;

use App\Components\Curl\CurlService;

class BaseService
{
    protected ?CurlService $client;
    protected $method;
    protected $uri;
    protected $timeout = 5;
    protected $fileCommon;
    protected $servicePath;
    protected $baseUrl;
    public function __construct()
    {
        $this->client = null;
    }
    public function setClient(CurlService $client): void
    {
        $this->client = $client;
    }

    protected function makeClient(): CurlService
    {
        if ($this->client) {
            return $this->client;
        }
        $configs = [
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout,
            'verify' => false,
        ];
        $this->client = new CurlService($configs);
        return $this->client;
    }

    public function doRequest($method, $uri, $options)
    {
        return $this->makeClient()->request($method, $uri, $options);
    }

    /**
     * @throws \Exception
     */
    protected function getUri(string $name)
    {
        $commonPath = $this->servicePath . '\\' . $this->fileCommon;

        if (empty($commonPath::LIST_URI[$name]['uri'])) {
            throw new \Exception('Missing uri');
        }

        return $commonPath::LIST_URI[$name]['uri'];
    }

    /**
     * @throws \Exception
     */
    protected function getMethod(string $name)
    {
        $commonPath = $this->servicePath . '\\' . $this->fileCommon;
        if (empty($commonPath::LIST_URI[$name]['method'])) {
            throw new \Exception('Missing method');
        }
        return $commonPath::LIST_URI[$name]['method'];
    }

}
