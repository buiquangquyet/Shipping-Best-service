<?php

namespace App\Api\Traits;

use Illuminate\Http\JsonResponse;

trait ApiTrait
{
    private function responseSuccess($data = [], $statusCode = 200): JsonResponse
    {
        return response()->json($data, $statusCode);
    }
}
