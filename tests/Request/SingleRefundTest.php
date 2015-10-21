<?php

namespace Tests\Request;

use HQ\AlipayApi\Request\SingleRefund;
use HQ\AlipayApi\RequestFactory;
use Tests\BaseTestCase;

require_once dirname(__DIR__).'/BaseTestCase.php';

/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class SingleRefundTest extends BaseTestCase
{
	public function testSingleRefund()
	{
		$response = $this->alipayManager->send(RequestFactory::SINGLE_REFUND, function(SingleRefund $request) {
			$request->setParam('out_trade_no', 'abc1234')
				->setParam('out_return_no', 'ref_abc1234')
				->setParam('return_amount', 0.1)
				->setParam('currency', 'USD')
				->setParam('gmt_return', '20151020183500')
				->setParam('reason', 'refund test');
		});

		$this->assertSame('F', $response->is_success);
		$this->assertSame('PURCHASE_TRADE_NOT_EXIST', $response->error);
	}
}