<?php

namespace DmApi;

class Params
{
    /**
     * @var string
     */
    public static $PARAM_ACTION = 'dm_public_api';
    /**
     * @var string
     */
    public static $PARAM_KEY = 'dm_public_api_key';

    /**
     * @var string
     */
    public static $PARAM_ACTION_CHECK_USER_EXISTS = 'checkUserExists';
    /**
     * @var string
     */
    public static $PARAM_ACTION_USER_REGISTRATION = 'userRegistration';
    /**
     * @var string
     */
    public static $PARAM_ACTION_USER_LOGIN = 'userLogin';
    /**
     * @var string
     */
    public static $PARAM_ACTION_LIST_ACCESSIBLE_PRODUCTS = 'listAccessableProducts';
    /**
     * @var string
     */
    public static $PARAM_ACTION_LIST_ACCESSIBLE_CONTENT = 'listAccessableContent';
    /**
     * @var string
     */
    public static $PARAM_ACTION_GET_LECTURE_MENU = 'getLectureMenu';
    /**
     * @var string
     */
    public static $PARAM_ACTION_LIST_ORDERS = 'listOrders';
    /**
     * @var string
     */
    public static $PARAM_ACTION_LIST_PRODUCTS = 'listProducts';
    /**
     * @var string
     */
    public static $PARAM_ACTION_GET_ORDER = 'getOrder';
    /**
     * @var string
     */
    public static $PARAM_ACTION_CREATE_ORDER = 'createOrder';

    /**
     * @var string
     */
    public static $PARAM_USER_EMAIL_OR_LOGIN_KEY = 'userEmail';
    /**
     * @var string
     */
    public static $PARAM_USER_PASSWORD = 'userPassword';
    /**
     * @var string
     */
    public static $PARAM_PRODUCT_ID = 'productId';
    /**
     * @var string
     */
    public static $PARAM_USER_ID = 'userId';
    /**
     * @var string
     */
    public static $PARAM_ORDER_ID = 'orderId';
}