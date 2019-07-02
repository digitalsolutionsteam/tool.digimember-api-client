<?php

namespace DmApi\Result;

/**
 * Class Order
 *
 * @package DmApi\Result
 */
class Order
{
    /** @var int */
    public $user_id;
    /** @var int */
    public $product_id;
    /** @var string */
    public $order_id;
    /** @var string */
    public $created;
    /** @var int */
    public $quantity;
    /** @var string */
    public $ds24_receipt_url;
    /** @var string */
    public $ds24_renew_url;
    /** @var string */
    public $ds24_add_url;
    /** @var string */
    public $ds24_support_url;
    /** @var string */
    public $ds24_rebilling_stop_url;
    /** @var string */
    public $ds24_request_refund_url;
    /** @var string */
    public $ds24_become_affiliate_url;
    /** @var string */
    public $ds24_newsletter_choice;
    /** @var int */
    public $age_in_days;
}