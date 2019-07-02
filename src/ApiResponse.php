<?php
namespace DmApi;

use Exception;
use GuzzleHttp\Exception\ClientException;
use JsonMapper;
use JsonMapper_Exception;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ApiResponse
{
    private static $SUCCESS = 'success';
    private static $ERROR = 'error';

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var string
     */
    private $state;

    /**
     * @var ApiException
     */
    private $error;

    /**
     * @var null | string
     */
    private $resultClass = null;

    /**
     * @var JsonMapper
     */
    private $mapper;

    /**
     * ApiResponse constructor.
     *
     * @param Throwable|ResponseInterface $response
     * @param null|string                 $resultClass
     */
    public function __construct($response, $resultClass = null)
    {
        $this->resultClass = $resultClass;
        $this->mapper = new JsonMapper();
        if ($response instanceof ClientException) {
            $message = json_decode($response->getResponse()->getBody()->getContents(), true);
            $this->error = new ApiException($response->getResponse()->getStatusCode(), $message['error'], $message['error_description']);
            $this->state = self::$ERROR;
        } else if ($response instanceof Exception) {
            $this->error = new ApiException($response->getCode(), $response->getMessage());
            $this->state = self::$ERROR;
        } else {
            $this->response = $response;
            $this->state = self::$SUCCESS;
        }
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->state == self::$SUCCESS;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return $this->state == self::$ERROR;
    }

    /**
     * @return ApiException
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return false|mixed
     */
    public function getData()
    {
        $data = $this->response ? json_decode($this->response->getBody()->getContents()) : false;
        if (!$data) {
            return $data;
        }
        if ($this->resultClass) {
            if (is_array($data)) {
                try {
                    $obj = $this->mapper->mapArray($data, [], $this->resultClass);
                } catch (JsonMapper_Exception $e) {
                    $obj = $data;
                }
            } else {
                try {
                    $obj = $this->mapper->map($data, new $this->resultClass());
                } catch (JsonMapper_Exception $e) {
                    $obj = $data;
                }
            }

            return $obj;
        }
        return (array)$data;
    }
}