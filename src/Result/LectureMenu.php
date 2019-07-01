<?php
namespace DmApi\Result;

/**
 * Class LectureMenu
 *
 * @package DmApi\Result
 */
class LectureMenu
{
    /** @var string */
    public $title;
    /** @var string */
    public $url;
    /** @var string */
    public $level;
    /** @var int */
    public $product_id;
    /** @var bool */
    public $is_selected;
    /** @var LectureMenu[] */
    public $sub_menu;
}