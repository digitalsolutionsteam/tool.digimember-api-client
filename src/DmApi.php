<?php

namespace DmApi;

use DmApi\Result\Content;
use DmApi\Result\LectureMenu;
use DmApi\Result\Order;
use DmApi\Result\Product;
use DmApi\Result\User;
use GuzzleHttp\Client;
use Throwable;

/**
 * Class DmApi
 *
 * @package DmApi
 */
class DmApi
{
    /**
     * @var string
     */
    protected $wpUrl;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var Client
     */
    protected $client;

    /**
     * DmApi constructor.
     *
     * @param string $wpUrl
     * @param string $apiKey
     */
    public function __construct($wpUrl, $apiKey)
    {
        $this->wpUrl = ltrim($wpUrl, '/');
        $this->apiKey = $apiKey;

        $this->client = new Client([
            'base_uri' => $this->wpUrl,
        ]);
    }

    /**
     * @param $userEmail
     *
     * @return User
     * @throws ApiException
     */
    public function checkUserExists($userEmail)
    {
        $result = $this->makeRequest(Params::$PARAM_ACTION_CHECK_USER_EXISTS, [
            Params::$PARAM_USER_EMAIL => $userEmail,
        ], User::class);
        if ($result->isSuccess()) {
            /** @var User $data */
            $data = $result->getData();
            return $data;
        }
        throw $result->getError();
    }

    /**
     * @param string $userEmail
     * @param int    $productId
     * @param string $orderId
     * @param string $userPassword
     *
     * @return User
     * @throws ApiException
     */
    public function userRegistration($userEmail, $productId, $orderId = '', $userPassword = '')
    {
        $result = $this->makeRequest(Params::$PARAM_ACTION_USER_REGISTRATION, [
            Params::$PARAM_USER_EMAIL => $userEmail,
            Params::$PARAM_PRODUCT_ID => $productId,
            Params::$PARAM_USER_PASSWORD => $userPassword,
            Params::$PARAM_ORDER_ID => $orderId,
        ], User::class);
        if ($result->isSuccess()) {
            /** @var User $data */
            $data = $result->getData();
            return $data;
        }
        throw $result->getError();
    }

    /**
     * @param $userEmail
     * @param $userPassword
     *
     * @return User
     * @throws ApiException
     */
    public function userLogin($userEmail, $userPassword)
    {
        $result = $this->makeRequest(Params::$PARAM_ACTION_USER_LOGIN, [
            Params::$PARAM_USER_EMAIL => $userEmail,
            Params::$PARAM_USER_PASSWORD => $userPassword,
        ], User::class);
        if ($result->isSuccess()) {
            /** @var User $data */
            $data = $result->getData();
            return $data;
        }
        throw $result->getError();
    }

    /**
     * @param int $userId
     *
     * @return Product[]
     * @throws ApiException
     */
    public function listAccessibleProducts($userId)
    {
        $result = $this->makeRequest(Params::$PARAM_ACTION_LIST_ACCESSIBLE_PRODUCTS, [
            Params::$PARAM_USER_ID => $userId,
        ], Product::class);
        if ($result->isSuccess()) {
            /** @var Product[] $data */
            $data = $result->getData();
            return $data;
        }
        throw $result->getError();
    }

    /**
     * @param int $userId
     * @param int $productId
     *
     * @return Content[]
     * @throws ApiException
     */
    public function listAccessibleContent($userId, $productId)
    {
        $result = $this->makeRequest(Params::$PARAM_ACTION_LIST_ACCESSIBLE_CONTENT, [
            Params::$PARAM_USER_ID => $userId,
            Params::$PARAM_PRODUCT_ID => $productId,
        ], Content::class);
        if ($result->isSuccess()) {
            /** @var Content[] $data */
            $data = $result->getData();
            return $data;
        }
        throw $result->getError();
    }

    /**
     * @param int $productId
     *
     * @return LectureMenu[]
     * @throws ApiException
     */
    public function getLectureMenu($productId)
    {
        $result = $this->makeRequest(Params::$PARAM_ACTION_GET_LECTURE_MENU, [
            Params::$PARAM_PRODUCT_ID => $productId,
        ], LectureMenu::class);
        if ($result->isSuccess()) {
            /** @var LectureMenu[] $data */
            $data = $result->getData();
            return $data;
        }
        throw $result->getError();
    }

    /**
     * @param $userId
     *
     * @return Order[]
     * @throws ApiException
     */
    public function listOrders($userId)
    {
        $result = $this->makeRequest(Params::$PARAM_ACTION_LIST_ORDERS, [
            Params::$PARAM_USER_ID => $userId,
        ], Order::class);
        if ($result->isSuccess()) {
            /** @var Order[] $data */
            $data = $result->getData();
            return $data;
        }
        throw $result->getError();
    }

    /**
     * @return Product[]
     * @throws ApiException
     */
    public function listProducts()
    {
        $result = $this->makeRequest(Params::$PARAM_ACTION_LIST_PRODUCTS, [], Product::class);
        if ($result->isSuccess()) {
            /** @var Product[] $data */
            $data = $result->getData();
            return $data;
        }
        throw $result->getError();
    }

    /**
     * @param string $orderId
     *
     * @return Order
     * @throws ApiException
     */
    public function getOrder($orderId)
    {
        $result = $this->makeRequest(Params::$PARAM_ACTION_GET_ORDER, [
            Params::$PARAM_ORDER_ID => $orderId,
        ], Order::class);
        if ($result->isSuccess()) {
            /** @var Order $data */
            $data = $result->getData();
            return $data;
        }
        throw $result->getError();
    }

    /**
     * @param string $userEmailOrLoginKey
     * @param int    $productId
     * @param string $orderId
     *
     * @return bool
     * @throws ApiException
     */
    public function createOrder($userEmailOrLoginKey, $productId, $orderId = 'by_public_api')
    {
        $result = $this->makeRequest(Params::$PARAM_ACTION_CREATE_ORDER, [
            Params::$PARAM_USER_EMAIL_OR_LOGIN_KEY => $userEmailOrLoginKey,
            Params::$PARAM_PRODUCT_ID => $productId,
            Params::$PARAM_ORDER_ID => $orderId,
        ]);
        if ($result->isSuccess()) {
            return true;
        }
        throw $result->getError();
    }

    /**
     * @param string        $action
     * @param array         $params
     * @param null | string $resultClass
     *
     * @return ApiResponse
     */
    protected function makeRequest(string $action, array $params, $resultClass = null)
    {
        $params = array_merge(
            $params,
            [
                Params::$PARAM_ACTION => $action,
                Params::$PARAM_KEY => $this->apiKey,
            ]
        );

        try {
            $response = $this->client->request('GET', '?' . http_build_query($params));
            return new ApiResponse($response, $resultClass);
        } catch (Throwable $e) {
            return new ApiResponse($e);
        }
    }
}