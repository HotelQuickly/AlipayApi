<?php
namespace Tests;

/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@gmail.com>
 */
abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
	/** @var \HQ\AlipayApi\Manager */
	protected $alipayManager;

	public function setUp()
	{
		require dirname(__DIR__) . '/tests/bootstrap.php';

		$this->alipayManager = $alipayManager;
	}
}