<?php
require_once __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/config.php';

$requestFactory = new \HQ\AlipayApi\RequestFactory($config['apiBaseUrl'], $config['merchantId'], $config['signKey']);
$alipayManager = new \HQ\AlipayApi\Manager($config['cacertFileName'], $requestFactory);