<?php
namespace App\Api\Base;

abstract class BaseTransform
{
    protected $data;
    public $transformedData;

    abstract protected function transformData();

    public function setData($data)
    {
        $this->data = $data;
    }

    public static function getTransformedData($data)
    {
        $class = new static();
        $class->setData($data);
        $class->transformData();
        return $class->transformedData;
    }

}
