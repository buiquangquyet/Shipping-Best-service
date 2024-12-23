<?php

namespace App\Api\V1\Services\LogService;

use Carbon\Carbon;
use Predis\Client as PredisClient;

class LogService
{
    protected $queue;
    protected $partner;

    protected $action;
    protected $requestFrom;
    protected $parentCode;

    protected $code;
    public $logMongoCode;

    public function __construct()
    {
        $this->queue = new PredisClient(
            config('database.redis.default'), ['prefix' => env('CACHE_PREFIX' . ':', 'ghtc:')]
        );
        $this->logMongoCode = LogCommon::randomLogMongoCode(5) . time() . LogCommon::randomLogMongoCode(5);
    }

    public function setCode($code): void
    {
        $this->code = $code;
    }
    public function setParentCode($parentCode): void
    {
        $this->parentCode = $parentCode;
    }

    public function setRequestLog($action, $requestFrom, $partner): void
    {
        $this->action = $action;
        $this->requestFrom = $requestFrom;
        $this->partner = $partner;
    }

    public function pushLog($data)
    {
        if(empty($this->action) || empty($this->requestFrom) || !empty($this->partner)) return false;
        $datalog['action'] = $this->action;
        $datalog['request_from'] = $this->requestFrom;
        $datalog['partner'] = $this->partner;
        $datalog['data'] = $data;
        $datalog['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
        if (!empty($this->code)) {
            $datalog['code'] = $this->code;
        }
        if (!empty($this->parentCode)) {
            $datalog['parent_code'] = $this->parentCode;
        }
        return $this->queue->lpush(LogCommon::KEY_QUEUE_LOG, json_encode($datalog));
    }
}
