<?php

namespace App\Components\Curl;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use stdClass;

class CurlService
{

    /**
     *
     *
     * Method           Default value    Description
     * withTimeout()    30 seconds    Set the timeout of the request (integer or float)
     * allowRedirect()    false    Allow the request to be redirected internally
     * asJsonRequest()    false    Submit the request data as JSON
     * asJsonResponse()    false    Decode the response data from JSON
     * asJson()    false    Utility method to set both asJsonRequest() and asJsonResponse() at the same time
     * withHeader()    string    Add an HTTP header to the request
     * withHeaders()    array    Add multiple HTTP headers to the request
     * withContentType()    none    Set the content type of the response
     * withFile()    none    Add a file to the form data to be sent
     * containsFile()    false    Should be used to submit files through forms
     * withData()    array    Add an array of data to sent with the request (GET or POST)
     * setCookieFile()    none    Set a file to read cookies from
     * setCookieJar()    none    Set a file to store cookies in
     * withOption()    none    Generic method to add any cURL option to the request
     */
    /** @var resource $curlObject cURL request */
    protected $curlObject = null;

    protected mixed $curlObjectLog = null;

    /** @var array $curlOptions Array of cURL options */
    protected array $curlOptions = array(
        'base_uri' => '',
        'RETURNTRANSFER' => true,
        'FAILONERROR' => false,
        'FOLLOWLOCATION' => false,
        'CONNECTTIMEOUT' => '',
        'TIMEOUT' => 0,
        'USERAGENT' => '',
        'URL' => '',
        'POST' => false,
        'HTTPHEADER' => array(),
        'SSL_VERIFYPEER' => false,
        'HEADER' => false,
    );
    protected array $ignoreCurlOption = array(
        'base_uri'
    );
    /** @var array $packageOptions Array with options that are not specific to cURL but are used by the package */
    protected array $packageOptions = array(
        'data' => array(),
        'files' => array(),
        'asJsonRequest' => false,
        'asJsonResponse' => false,
        'returnAsArray' => false,
        'responseObject' => false,
        'responseArray' => false,
        'enableDebug' => false,
        'xDebugSessionName' => '',
        'containsFile' => false,
        'debugFile' => '',
        'saveFile' => '',
    );

    public function __construct(array $config = [])
    {
        if (isset($config['base_uri_v3'])) {
            $this->curlOptions['base_uri'] = $config['base_uri_v3'];
        }
        if (isset($config['base_uri'])) {
            $this->curlOptions['base_uri'] = $config['base_uri'];
        }
        if (isset($config['timeout']) && is_numeric($config['timeout'])) {
            $this->curlOptions['TIMEOUT'] = $config['timeout'];
        }
        if (isset($config['headers'])) {
            $this->withHeaders($config['headers']);
        }

    }

    /**
     * Set the URL to which the request is to be sent
     *
     * @param $url string   The URL to which the request is to be sent
     * @return CurlService
     */
    public function to(string $url): static
    {
        $url = $this->buildUri($url);
        return $this->withCurlOption('URL', $url);
    }

    private function buildUri($uri)
    {
        $fullUrl = $uri;
        if ($this->curlOptions['base_uri']) {
            $baseUri = $this->curlOptions['base_uri'];
            if (str_ends_with($baseUri, '/')) {
                $baseUri = substr($baseUri, 0, strlen($baseUri) - 1);
            }
            if (str_starts_with($uri, '/')) {
                $uri = substr($uri, 1, strlen($uri) - 1);
            }
            $fullUrl = $baseUri . '/' . $uri;
        }
        if (str_contains($uri, 'http://') || str_contains($uri, 'https://')) {
            return $uri;
        }
        return $fullUrl;
    }


    /**
     * Set the request timeout
     *
     * @param float $timeout The timeout for the request (in seconds, fractions of a second are okay. Default: 30 seconds)
     * @return CurlService
     */
    public function withTimeout($timeout = 30.0)
    {
        return $this->withCurlOption('TIMEOUT', $timeout);
    }

    /**
     * Add GET or POST data to the request
     *
     * @param mixed $data Array of data that is to be sent along with the request
     * @return CurlService
     */
    public function withData($data = array())
    {
        return $this->withPackageOption('data', $data);
    }

    /**
     * Add a file to the request
     *
     * @param string $key Identifier of the file (how it will be referenced by the server in the $_FILES array)
     * @param string $path Full path to the file you want to send
     * @param string $mimeType Mime type of the file
     * @param string $postFileName Name of the file when sent. Defaults to file name
     *
     * @return CurlService
     */
    public function withFile($key, $path, $mimeType = '', $postFileName = '')
    {
        $fileData = array(
            'fileName' => $path,
            'mimeType' => $mimeType,
            'postFileName' => $postFileName,
        );

        $this->packageOptions['files'][$key] = $fileData;

        return $this->containsFile();
    }

    /**
     * Allow for redirects in the request
     *
     * @return CurlService
     */
    public function allowRedirect()
    {
        return $this->withCurlOption('FOLLOWLOCATION', true);
    }

    /**
     * Configure the package to encode and decode the request data
     *
     * @param boolean $asArray Indicates whether or not the data should be returned as an array. Default: false
     * @return CurlService
     */
    public function asJson($asArray = false)
    {
        return $this->asJsonRequest()
            ->asJsonResponse($asArray);
    }

    /**
     * Configure the package to encode the request data to json before sending it to the server
     *
     * @return CurlService
     */
    public function asJsonRequest()
    {
        return $this->withPackageOption('asJsonRequest', true);
    }

    /**
     * Configure the package to decode the request data from json to object or associative array
     *
     * @param boolean $asArray Indicates whether or not the data should be returned as an array. Default: false
     * @return CurlService
     */
    public function asJsonResponse($asArray = false)
    {
        return $this->withPackageOption('asJsonResponse', true)
            ->withPackageOption('returnAsArray', $asArray);
    }

//    /**
//     * Send the request over a secure connection
//     *
//     * @return CurlService
//     */
//    public function secure()
//    {
//        return $this;
//    }

    /**
     * Set any specific cURL option
     *
     * @param string $key The name of the cURL option
     * @param mixed $value The value to which the option is to be set
     * @return CurlService
     */
    public function withOption($key, $value)
    {
        return $this->withCurlOption($key, $value);
    }

    /**
     * Set Cookie File
     *
     * @param string $cookieFile File name to read cookies from
     * @return CurlService
     */
    public function setCookieFile($cookieFile)
    {
        return $this->withOption('COOKIEFILE', $cookieFile);
    }

    /**
     * Set Cookie Jar
     *
     * @param string $cookieJar File name to store cookies to
     * @return CurlService
     */
    public function setCookieJar($cookieJar)
    {
        return $this->withOption('COOKIEJAR', $cookieJar);
    }

    /**
     * Set any specific cURL option
     *
     * @param string $key The name of the cURL option
     * @param string $value The value to which the option is to be set
     * @return CurlService
     */
    protected function withCurlOption($key, $value)
    {
        $this->curlOptions[$key] = $value;

        return $this;
    }

    /**
     * Set any specific package option
     *
     * @param string $key The name of the cURL option
     * @param string $value The value to which the option is to be set
     * @return CurlService
     */
    protected function withPackageOption($key, $value)
    {
        $this->packageOptions[$key] = $value;

        return $this;
    }

    /**
     * Add a HTTP header to the request
     *
     * @param string $header The HTTP header that is to be added to the request
     * @return CurlService
     */
    public function withHeader($header)
    {
        $this->curlOptions['HTTPHEADER'][] = $header;

        return $this;
    }

    /**
     * Add multiple HTTP header at the same time to the request
     *
     * @param array $headers Array of HTTP headers that must be added to the request
     * @return CurlService
     */
    public function withHeaders(array $headers)
    {
        $data = array();
        foreach ($headers as $key => $value) {
            if (!is_numeric($key)) {
                $value = $key . ': ' . $value;
            }

            $data[] = $value;
        }

        $this->curlOptions['HTTPHEADER'] = array_merge(
            $this->curlOptions['HTTPHEADER'], $data
        );

        return $this;
    }

    /**
     * Add a content type HTTP header to the request
     *
     * @param string $contentType The content type of the file you would like to download
     * @return CurlService
     */
    public function withContentType($contentType)
    {
        return $this->withHeader('Content-Type: ' . $contentType)
            ->withHeader('Connection: Keep-Alive');
    }

    /**
     * Add response headers to the response object or response array
     *
     * @return CurlService
     */
    public function withResponseHeaders()
    {
        return $this->withCurlOption('HEADER', TRUE);
    }

    /**
     * Return a full response object with HTTP status and headers instead of only the content
     *
     * @return CurlService
     */
    public function returnResponseObject()
    {
        return $this->withPackageOption('responseObject', true);
    }

    /**
     * Return a full response array with HTTP status and headers instead of only the content
     *
     * @return CurlService
     */
    public function returnResponseArray()
    {
        return $this->withPackageOption('responseArray', true);
    }

    /**
     * Enable debug mode for the cURL request
     *
     * @param string $logFile The full path to the log file you want to use
     * @return CurlService
     */
    public function enableDebug($logFile)
    {
        return $this->withPackageOption('enableDebug', true)
            ->withPackageOption('debugFile', $logFile)
            ->withOption('VERBOSE', true);
    }

    /**
     * Enable Proxy for the cURL request
     *
     * @param string $proxy Hostname
     * @param string $port Port to be used
     * @param string $type Scheme to be used by the proxy
     * @param string $username Authentication username
     * @param string $password Authentication password
     * @return CurlService
     */
    public function withProxy($proxy, $port = '', $type = '', $username = '', $password = '')
    {
        $this->withOption('PROXY', $proxy);

        if (!empty($port)) {
            $this->withOption('PROXYPORT', $port);
        }

        if (!empty($type)) {
            $this->withOption('PROXYTYPE', $type);
        }

        if (!empty($username) && !empty($password)) {
            $this->withOption('PROXYUSERPWD', $username . ':' . $password);
        }

        return $this;
    }

    /**
     * Enable File sending
     *
     * @return CurlService
     */
    public function containsFile()
    {
        return $this->withPackageOption('containsFile', true);
    }

    /**
     * Add the XDebug session name to the request to allow for easy debugging
     *
     * @param string $sessionName
     * @return CurlService
     */
    public function enableXDebug($sessionName = 'session_1')
    {
        $this->packageOptions['xDebugSessionName'] = $sessionName;

        return $this;
    }

    /**
     * Send a GET request to a URL using the specified cURL options
     * @param string $uri
     * @return mixed
     */
    public function get($uri = '')
    {
        $this->to($uri);
        $this->appendDataToURL();

        return $this->send();
    }

    /**
     * Send a POST request to a URL using the specified cURL options
     * @param string $uri
     * @param array $data
     * @return mixed
     */
    public function post($uri)
    {
        $this->to($uri);
        $this->setPostParameters();

        return $this->send();
    }

    /**
     * Send a download request to a URL using the specified cURL options
     *
     * @param string $fileName
     * @return mixed
     */
    public function download($fileName)
    {
        $this->packageOptions['saveFile'] = $fileName;

        return $this->send();
    }

    /**
     * Add POST parameters to the curlOptions array
     */
    protected function setPostParameters()
    {
        $this->curlOptions['POST'] = true;

        $parameters = $this->packageOptions['data'];
        if (!empty($this->packageOptions['files'])) {
            foreach ($this->packageOptions['files'] as $key => $file) {
                $parameters[$key] = $this->getCurlFileValue($file['fileName'], $file['mimeType'], $file['postFileName']);
            }
        }

        if ($this->packageOptions['asJsonRequest']) {
            $parameters = json_encode($parameters);
        }

        $this->curlOptions['POSTFIELDS'] = $parameters;
    }

    protected function getCurlFileValue($filename, $mimeType, $postFileName)
    {
        // PHP 5 >= 5.5.0, PHP 7
        if (function_exists('curl_file_create')) {
            return curl_file_create($filename, $mimeType, $postFileName);
        }

        // Use the old style if using an older version of PHP
        $value = "@{$filename};filename=" . $postFileName;
        if ($mimeType) {
            $value .= ';type=' . $mimeType;
        }

        return $value;
    }

    /**
     * Send a PUT request to a URL using the specified cURL options
     *
     * @param string $uri
     * @return mixed
     * @throws CurlException
     */
    public function put($uri = '')
    {
        $this->to($uri);
        $this->setPostParameters();

        return $this->withOption('CUSTOMREQUEST', 'PUT')
            ->send();
    }

    /**
     * Send a PATCH request to a URL using the specified cURL options
     *
     * @param string $uri
     * @return mixed
     * @throws CurlException
     */
    public function patch($uri = '')
    {
        $this->to($uri);
        $this->setPostParameters();

        return $this->withOption('CUSTOMREQUEST', 'PATCH')
            ->send();
    }

    /**
     * Send a DELETE request to a URL using the specified cURL options
     *
     * @param string $uri
     * @return mixed
     * @throws CurlException
     */
    public function delete($uri = '')
    {
        $this->to($uri);
        $this->appendDataToURL();

        return $this->withOption('CUSTOMREQUEST', 'DELETE')
            ->send();
    }

    /**
     * Send the request
     *
     * @return mixed
     * @throws CurlException
     */
    protected function send()
    {
        // Add JSON header if necessary
        if ($this->packageOptions['asJsonRequest']) {
            $this->withHeader('Content-Type: application/json');
        }

        if ($this->packageOptions['enableDebug']) {
            $debugFile = fopen($this->packageOptions['debugFile'], 'w');
            $this->withOption('STDERR', $debugFile);
        }
        $logLevel = env('LOG_CURL_LEVEL', 'ERROR');
        $timeStart = microtime(true);

        // Create the request with all specified options
        $this->curlObject = curl_init();
        $options = $this->forgeOptions();
        curl_setopt_array($this->curlObject, $options);

        // Send the request
        $response = curl_exec($this->curlObject);
        $this->setCurlObjectLog();

        $responseCode = curl_getinfo($this->curlObject, CURLINFO_HTTP_CODE);

        $responseHeader = null;
        if ($this->curlOptions['HEADER']) {
            $headerSize = curl_getinfo($this->curlObject, CURLINFO_HEADER_SIZE);
            $responseHeader = substr($response, 0, $headerSize);
            $response = substr($response, $headerSize);
        }
        // Capture additional request information if needed
        $responseData = array();
        if ($this->packageOptions['responseObject'] || $this->packageOptions['responseArray']) {
            $responseData = curl_getinfo($this->curlObject);
        }

        $durationTime = round(microtime(true) - $timeStart, 5);
        $messageError = '';
        if (curl_errno($this->curlObject)) {
            $responseData['errorMessage'] = curl_error($this->curlObject);
            if ($logLevel === 'ALL' || $logLevel === 'ERROR') {
                $logData = [
                    'requestData' => $options,
                    'responseData' => $responseData,
                    'durationTime' => $durationTime . 's',
                ];
                @Log::channel('log-url')->error($this->curlOptions['URL'] . ': ' . $responseData['errorMessage'], $logData);
            }
            throw new CurlException($responseData['errorMessage'], $options, $response, null, $responseHeader, $responseCode);
        }
        curl_close($this->curlObject);

        if ($this->packageOptions['saveFile']) {
            // Save to file if a filename was specified
            $file = fopen($this->packageOptions['saveFile'], 'w');
            fwrite($file, $response);
            fclose($file);
        } elseif ($this->packageOptions['asJsonResponse']) {
            // Decode the request if necessary
            $response = json_decode($response, $this->packageOptions['returnAsArray']);
        }
        if ($responseCode < Response::HTTP_OK || $responseCode > Response::HTTP_IM_USED) { // responseCode != 2xx -> error
            if ($logLevel === 'ALL' || $logLevel === 'ERROR') {
                $logData = [
                    'requestData' => $options,
                    'responseData' => $response,
                    'durationTime' => $durationTime . 's',
                ];
                @Log::channel('log-url')->error($this->curlOptions['URL'] . ': ' . $responseCode, $logData);
            }
            throw new CurlException($messageError, $options, $response, null, $responseHeader, $responseCode);
        }
        if ($this->packageOptions['enableDebug']) {
            fclose($debugFile);
        }

        if ($logLevel === 'ALL') {
            $logData = [
                'requestData' => $options,
                'responseData' => $response,
                'durationTime' => $durationTime . 's',
            ];
            @Log::channel('log-url')->info($this->curlOptions['URL'] . ': ' . $responseCode, $logData);
        }

        // Return the result
        return $this->returnResponse($response, $responseData, $responseHeader);
    }

    /**
     * @param string $headerString Response header string
     * @return mixed
     */
    protected function parseHeaders($headerString)
    {
        $headers = array_filter(array_map(function ($x) {
            $arr = array_map('trim', explode(':', $x, 2));
            if (count($arr) == 2) {
                return [$arr[0] => $arr[1]];
            }
        }, array_filter(array_map('trim', explode("\r\n", $headerString)))));

        $results = [];

        foreach ($headers as $values) {
            if (!is_array($values)) {
                continue;
            }

            $key = array_keys($values)[0];
            if (isset($results[$key])) {
                $results[$key] = array_merge(
                    (array)$results[$key],
                    array(array_values($values)[0])
                );
            } else {
                $results = array_merge(
                    $results,
                    $values
                );
            }
        }

        return $results;
    }

    /**
     * @param mixed $content Content of the request
     * @param array $responseData Additional response information
     * @param string $header Response header string
     * @return mixed
     */
    protected function returnResponse($content, array $responseData = array(), $header = null)
    {
        if (!$this->packageOptions['responseObject'] && !$this->packageOptions['responseArray']) {
            return $content;
        }

        $object = new stdClass();
        $object->content = $content;
        $object->status = $responseData['http_code'];
        $object->contentType = $responseData['content_type'];
        if (array_key_exists('errorMessage', $responseData)) {
            $object->error = $responseData['errorMessage'];
        }

        if ($this->curlOptions['HEADER']) {
            $object->headers = $this->parseHeaders($header);
        }

        if ($this->packageOptions['responseObject']) {
            return $object;
        }

        if ($this->packageOptions['responseArray']) {
            return (array)$object;
        }

        return $content;
    }

    /**
     * Convert the curlOptions to an array of usable options for the cURL request
     *
     * @return array
     */
    protected function forgeOptions()
    {
        $results = array();
        foreach ($this->curlOptions as $key => $value) {
            if (!in_array($key, $this->ignoreCurlOption)) {
                $arrayKey = constant('CURLOPT_' . $key);
                if (!$this->packageOptions['containsFile'] && $key == 'POSTFIELDS' && is_array($value)) {
                    $results[$arrayKey] = http_build_query($value, null, '&');
                } else {
                    $results[$arrayKey] = $value;
                }
            }
        }

        if (!empty($this->packageOptions['xDebugSessionName'])) {
            $char = strpos($this->curlOptions['URL'], '?') ? '&' : '?';
            $this->curlOptions['URL'] .= $char . 'XDEBUG_SESSION_START=' . $this->packageOptions['xDebugSessionName'];
        }

        return $results;
    }

    /**
     * Append set data to the query string for GET and DELETE cURL requests
     *
     * @return string
     */
    protected function appendDataToURL()
    {
        $parameterString = '';
        if (is_array($this->packageOptions['data']) && count($this->packageOptions['data']) != 0) {
            $parameterString = '?' . http_build_query($this->packageOptions['data'], null, '&');
        }

        return $this->curlOptions['URL'] .= $parameterString;
    }

    /**
     * request to url
     * @param $method
     * @param $uri
     * @param $options
     * @return mixed
     */
    public function request($method, $uri, $options)
    {
        // Set header
        $headers = $options['headers'] ?? [];
        if ($headers) {
            $this->withHeaders($headers);
            unset($options['headers']);
        }

        // Set Auth: basic, digest, ntlm
        if (!empty($options['auth']) && is_array($options['auth'])) {
            $value = $options['auth'];
            $type = isset($value[2]) ? strtolower($value[2]) : 'basic';
            switch ($type) {
                case 'basic':
                    $this->withHeader('Authorization: Basic ' . base64_encode("$value[0]:$value[1]"));
                    break;
                case 'digest':
                    // @todo: Do not rely on curl
                    $this->withCurlOption('HTTPAUTH', CURLAUTH_DIGEST);
                    $this->withCurlOption('USERPWD', "$value[0]:$value[1]");
                    break;
                case 'ntlm':
                    $this->withCurlOption('HTTPAUTH', CURLAUTH_NTLM);
                    $this->withCurlOption('USERPWD', "$value[0]:$value[1]");
                    break;
            }
            unset($options['auth']);
        }

        // Set data body
        if (isset($options['json'])) {
            $response = $this->withData($options['json'])->asJson(true)->$method($uri);
        } elseif (isset($options['form_params'])) {
            $this->withHeader('Content-Type: application/x-www-form-urlencoded');
            $response = $this->withData($options['form_params'])->asJsonResponse(true)->$method($uri);
        } elseif (isset($options['query_params'])) {
            $response = $this->withData($options['query_params'])->asJsonResponse(true)->$method($uri);
        } elseif ($options) {
            $response = $this->withData($options)->asJsonResponse(true)->$method($uri);
        } else {
            $response = $this->asJsonResponse(true)->$method($uri);
        }

        return $response;
    }

    public function setCurlObjectLog()
    {
        $this->curlObjectLog = curl_getinfo($this->curlObject, CURLINFO_REDIRECT_URL);
    }

    public function getCurlObjectLog()
    {
        return $this->curlObjectLog;
    }
}
