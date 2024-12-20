<?php

namespace App\Components\Curl;

use Exception;
use Illuminate\Http\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

/**
 * HTTP Request exception
 */
class CurlException extends HttpException implements Throwable
{
    /** @var RequestInterface */
    private $request;

    /** @var ResponseInterface */
    private $response;

    public function __construct(
        $message,
        $request = null,
        $response = null,
        \Exception $previous = null,
        $header = [],
        $code = 0
    )
    {
        if (!$message) {
            $message = Response::$statusTexts[$code] ?? $code;
        }
        // convert header to array
        $header = !empty($header) ? $header : [];
        $header = is_array($header) ? $header : json_decode(json_encode($header), true);
        parent::__construct(Response::HTTP_UNPROCESSABLE_ENTITY, $message, $previous, $header, $code);

        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Get the request that caused the exception
     *
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get the associated response
     *
     * @return ResponseInterface|null
     */
    public function getResponse()
    {
        return $this->response;
    }

}
