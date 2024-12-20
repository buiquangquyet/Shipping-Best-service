<?php

namespace App\Api\Traits;

use Illuminate\Http\JsonResponse;

trait ApiTrait
{
    private function responseSuccess(array $data, $isMerge = false, $statusCode = 200): JsonResponse
    {
        $defaultResponse = [
            'Result' => 1,
            'Message' => null,
        ];

        if ($isMerge) {
            $defaultResponse = array_merge($defaultResponse, $data);
            return response()->json($defaultResponse, $statusCode);
        }

        $defaultResponse['data'] = $data;
        return response()->json($defaultResponse, $statusCode);
    }
    private function responseError($message, $statusCode = 422): JsonResponse
    {
        $defaultResponse = [
            'Result' => 2,
            'Message' => $message,
        ];
        return response()->json($defaultResponse, $statusCode);
    }
}
