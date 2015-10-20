<?php
namespace HQ\AlipayApi\Request;

/**
 * Class SingleRefund
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class SingleRefund extends RequestAbstract
{
	protected $_serviceName = 'forex_refund';
	protected $_method = self::METHOD_GET;

	protected $_mandatoryParams = [
		'out_return_no',
		'out_trade_no',
		'return_amount',
		'currency',
		'gmt_return',
		'reason'
	];
}