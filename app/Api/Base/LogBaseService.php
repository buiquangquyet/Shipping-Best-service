<?php

namespace App\Api\Base;
use Exception;

abstract class LogBaseService
{
    protected $servicePath;
    protected $collection;

    protected function _transformData($transformName, array $data)
    {
        try {
            $transform = $this->servicePath . '\Transforms\\' . $transformName;
            return $transform::getTransformedData($data);
        } catch (Exception $exception) {
            throw new Exception(__($exception->getMessage()));
        }
    }

    public function insert($data)
    {
        try {
            $dataTransform = $this->_transformData('InsertDataTransform', ['dataRequest' => $data]);
            return $this->collection->insert($dataTransform);
        } catch (\Exception $exception) {
            throw new Exception(__($exception->getMessage()));
        }
    }

}
