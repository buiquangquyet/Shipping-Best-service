<?php

namespace App\Api\V1\Controllers;

use App\Api\Traits\ApiTrait;
use App\Api\V1\Requests\LoginRequest;
use App\Api\V1\Services\DeliveryService\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    use ApiTrait;
    public function __construct(private readonly LoginService $loginService)
    {}

    /**
     * @throws \Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $response = $this->loginService->login($data);

            return $this->responseSuccess($response, true);
        }catch (\Exception $exception) {

            return $this->responseError($exception->getMessage());
        }
    }
}
