<?php

namespace DmApi;

use Exception;
use Throwable;

/**
 * Class ApiException
 */
class ApiException extends Exception
{
    /** @var string */
    public $description;

    /**
     * ApiException constructor.
     *
     * @param string         $code
     * @param string         $message
     * @param string         $description
     * @param Throwable|null $previous
     */
    public function __construct($code, $message = '', $description = '', Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}