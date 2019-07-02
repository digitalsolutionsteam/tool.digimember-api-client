<?php

use DmApi\DmApi;

require __DIR__ . '/vendor/autoload.php';

$api = new DmApi('https://my-wordpress.site', '32-char-long-api-key');

echo '<pre>';
try {
    $orderId = md5(time());
    $user = $api->userRegistration('test@email.com', 1, $orderId, 'password123');
    $result = $api->getOrder($orderId);
    var_dump($result);
} catch (Exception $e) {
    var_dump($e);
}
