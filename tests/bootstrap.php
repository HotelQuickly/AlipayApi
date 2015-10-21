<?php
require_once __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/config.php';

$alipayManager = new \HQ\AlipayApi\Manager($config['apiBaseUrl'], $config['merchantId'], $config['signKey'], $config['cacertFileName']);