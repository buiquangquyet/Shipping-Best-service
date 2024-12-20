<?php
namespace App\Api\V1\Services\LogService\LogCreateOrder\Transforms;

use App\Base\BaseTransform;
class InsertDataTransform extends BaseTransform
{
    protected function transformData()
    {
        $data = [];
        $dataRequest = $this->data['dataRequest'] ?? [];
        if($dataRequest){
            foreach ($dataRequest as $key => $item){
                $data[$key] = [
                    'action' => $item['action'],
                    'created_at' => $item['created_at']
                ];
                if(!empty($item['partner'])){
                    $data[$key]['partner'] = $item['partner'];
                }
                if(!empty($item['request_from'])){
                    $data[$key]['request_from'] = $item['request_from'];
                }
                if(!empty($item['code'])){
                    $data[$key]['code'] = $item['code'];
                }
                if(!empty($item['parent_code'])){
                    $data[$key]['parent_code'] = $item['parent_code'];
                }
                if(!empty($item['data'])){
                    $data[$key]['data'] = $item['data'];
                }
                if(!empty($item['data']['status'])){
                    $data[$key]['status'] = $item['data']['status'];
                }
                if(!empty($item['data']['message'])){
                    $data[$key]['message'] = $item['data']['message'];
                }
            }
        }
        $this->transformedData = $data;
    }
}
