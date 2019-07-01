<?php
namespace DmApi;

use DmApi\Result\User;
use GuzzleHttp\Exception\ClientException;
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
     * ApiResponse constructor.
     *
     * @param Throwable|ResponseInterface $response
     * @param null|string                 $resultClass
     */
    public function __construct($response, $resultClass = null)
    {
        $this->resultClass = $resultClass;
        if ($response instanceof ClientException) {
            $message = json_decode($response->getResponse()->getBody()->getContents(), true);
            $this->error = new ApiException($response->getResponse()->getStatusCode(), $message['error'], $message['error_description']);
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
                $arr = [];
                foreach ($data as $entry) {
                    $obj = new $this->resultClass();
                    foreach ($entry as $key => $val) {
                        $obj->$key = $val;
                    }
                    $arr[] = $obj;
                }
                $obj = $arr;
            } else {
                $obj = new $this->resultClass();
                foreach ($data as $key => $val) {
                    $obj->$key = $val;
                }
            }

            return $obj;
        }
        return (array)$data;
    }
}