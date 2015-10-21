<?php

namespace Tests\Request;

use HQ\AlipayApi\Request\SingleTransactionQuery;
use HQ\AlipayApi\RequestFactory;
use Tests\BaseTestCase;

require_once dirname(__DIR__).'/BaseTestCase.php';

/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class SingleTransactionQueryTest extends BaseTestCase
{
	public function testSingleTransactionQuery()
	{
		$response = $this->alipayManager->send(RequestFactory::SINGLE_TRANSACTION_QUERY, function(SingleTransactionQuery $request) {
			$request->setParam('out_trade_no', 'abc1234');
		});

		$this->assertSame('F', $response->is_success);
		$this->assertSame('TRADE_NOT_EXIST', $response->error);
	}
}