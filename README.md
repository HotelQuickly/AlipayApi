# AlipayApi

[![Build Status](https://travis-ci.org/HotelQuickly/AlipayApi.svg?branch=master)](https://travis-ci.org/HotelQuickly/AlipayApi)


### Installation
1) Add this repository to composer.json, or run:
```sh
$ composer require hotel-quickly/alipay-api:@dev
```
2) Register extension in your bootstrap.php
```php
$configurator->onCompile[] = function ($configurator, $compiler) {
    $compiler->addExtension('alipayApi', new \HQ\AlipayApi\AlipayApiExtension());
};
```

### Configuration
Add this to your config.neon
```yml
alipayApi:
	apiBaseUrl: https://sandbox-api-pay.line.me/v1
    merchantId: abc
    signKey: abc
    cacertFileName: cacert.pem
```

### Usage
```php
/** @var \HQ\AlipayApi\Manager @autowire */
private $alipayManager;

$response = $this->alipayManager->send(RequestFactory::SINGLE_TRANSACTION_QUERY, function(SingleTransactionQuery $request) {
	$request->setParam('out_trade_no', 'abc1234');
});
```

### How to add new Request
- 1) Create new file and extends from `RequestAbstract` class
- 2) Add new const of request name to `RequestFactory` class
- 3) Inside created Request file, add necessary attributes such as $_serviceName, $_method, $_mandatoryParams, and $_optionalParams

### How to test
```sh
$ ./vendor/bin/tester tests/
```

### The MIT License (MIT)
Copyright (c) 2014 Hotel Quickly Ltd.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.