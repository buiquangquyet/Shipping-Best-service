<?php

namespace App\Console\Commands;

use App\Api\Base\LogServiceFactory;
use App\Api\V1\Services\LogService\LogCommon;
use App\Base\ServiceFactory;
use Illuminate\Console\Command;
use Predis\Client as PredisClient;

class LogQueueCommand extends Command
{
    protected $signature = 'app:log-queue-command';
    protected $description = 'Read queue log insert DB';
    protected $queue;
    protected $keyQueue;
    protected $limit = 150;

    public function __construct()
    {
        $this->queue = new PredisClient(
            config('database.redis.default'), ['prefix' => env('CACHE_PREFIX' . ':', 'ghtc:')]
        );
        parent::__construct();
    }

    public function handle()
    {
        $this->info('--START--');
        $countData = $this->queue->llen(LogCommon::KEY_QUEUE_LOG);
        if($countData > 0){
            $dataArr = [];
            for ($i = 0; $i < $countData; $i++) {
                $queue = json_decode($this->queue->rpop($this->keyQueue), true);
                if(!empty($queue)){
                    if(!empty($queue['action'])){
                        $findKeyArray = $this->findKeyArray($dataArr, $queue['action']);
                        $dataArr[$queue['action']][$findKeyArray][]= $queue;
                    }
                }
            }
            if(!empty($dataArr)){
                foreach($dataArr as $action => $data){
                    $service = LogServiceFactory::create($action);
                    if(!empty($data)){
                        foreach($data as $item){
                            $service->insert($item);
                            sleep(2);
                        }
                    }

                }
            }
        }
        $this->info('--END--');
    }

    private function findKeyArray($data, $type){
        if(empty($data[$type])) return 0;
        $keyFind = -1;
        foreach ($data[$type] as $key => $row){
            if(count($row) < $this->limit){
                $keyFind = $key; break;
            }elseif(count($row) == $this->limit){
                $keyFind = $key + 1;
            }
        }
        return ($keyFind == -1) ? 0 : $keyFind;
    }
}
