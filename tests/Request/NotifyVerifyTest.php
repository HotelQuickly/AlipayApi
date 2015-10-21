<?php

namespace Tests\Request;

use HQ\AlipayApi\Request\NotifyVerify;
use HQ\AlipayApi\RequestFactory;
use Tests\BaseTestCase;

require_once dirname(__DIR__).'/BaseTestCase.php';

/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class NotifyVerifyTest extends BaseTestCase
{
	public function testNotifyVerify()
	{
		$response = $this->alipayManager->send(RequestFactory::NOTIFY_VERIFY, function(NotifyVerify $request) {
			$request->setParam('notify_id', 'abcdefghijklmnopqrst');
		});

		$this->assertSame('false', $response);
	}
}