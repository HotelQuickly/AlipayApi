<?php
namespace HQ\AlipayApi\Request;

/**
 * Class NotifyVerify
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class NotifyVerify extends RequestAbstract
{
	protected $_serviceName = 'notify_verify';
	protected $_method = self::METHOD_GET;

	protected $_mandatoryParams = [
		'notify_id'
	];

	/**
	 * @param $apiResponse
	 * @return boolean
	 */
	public function handleResponse($apiResponse)
	{
		return $apiResponse;
	}
}