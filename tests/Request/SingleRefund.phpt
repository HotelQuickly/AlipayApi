<?php

namespace Tests;

use HQ\AlipayApi\Request\SingleRefund;
use HQ\AlipayApi\RequestFactory;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../BaseTestCase.php';
/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class SingleRefundTest extends BaseTestCase
{
	/** @var  \HQ\AlipayApi\Manager */
	private $alipayManager;

	public function setUp()
	{
		$this->alipayManager = $this->container->getByType('HQ\AlipayApi\Manager');
	}

	public function testSingleTransactionQuery()
	{
		$response = $this->alipayManager->send(RequestFactory::SINGLE_REFUND, function(SingleRefund $request) {
			$request->setParam('out_trade_no', 'abc1234')
				->setParam('out_return_no', 'ref_abc1234')
				->setParam('return_amount', 0.1)
				->setParam('currency', 'USD')
				->setParam('gmt_return', '20151020183500')
				->setParam('reason', 'refund test');
		});

		Assert::same('F', $response->is_success);
		Assert::same('PURCHASE_TRADE_NOT_EXIST', $response->error);
	}
}

$test = new SingleRefundTest($container);
$test->run();