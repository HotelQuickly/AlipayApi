<?php

namespace Tests;

use HQ\AlipayApi\Request\SingleTransactionQuery;
use HQ\AlipayApi\RequestFactory;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../BaseTestCase.php';
/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class SingleTransactionQueryTest extends BaseTestCase
{
	/** @var  \HQ\AlipayApi\Manager */
	private $alipayManager;

	public function setUp()
	{
		$this->alipayManager = $this->container->getByType('HQ\AlipayApi\Manager');
	}

	public function testSingleTransactionQuery()
	{
		$response = $this->alipayManager->send(RequestFactory::SINGLE_TRANSACTION_QUERY, function(SingleTransactionQuery $request) {
			$request->setParam('out_trade_no', 'abc1234');
		});

		Assert::same('F', $response->is_success);
		Assert::same('TRADE_NOT_EXIST', $response->error);
	}
}

$test = new SingleTransactionQueryTest($container);
$test->run();