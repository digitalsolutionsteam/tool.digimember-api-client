<?php
namespace DmApi\Result;

/**
 * Class Product
 *
 * @package DmApi\Result
 */
class Product
{
    /** @var int */
    public $id;
    /** @var string */
    public $created;
    /** @var string */
    public $name;
    /** @var string | null */
    public $first_login_url;
    /** @var string | null */
    public $default_login_url;
    /** @var string | null */
    public $shortcode_url;
    /** @var array */
    public $properties;
}