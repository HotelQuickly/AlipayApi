<?php
namespace HQ\AlipayApi\Request;

/**
 * Class SingleTransactionQuery
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class SingleTransactionQuery extends RequestAbstract
{
	protected $_serviceName = 'single_trade_query';
	protected $_method = self::METHOD_GET;

	protected $_mandatoryParams = [
		'out_trade_no'
	];
}