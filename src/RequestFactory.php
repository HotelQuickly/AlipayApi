<?php

namespace HQ\AlipayApi;

/**
 * Class RequestFactory
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class RequestFactory
{
	// These const are Request Names
	const SINGLE_TRANSACTION_QUERY = 'SingleTransactionQuery';
	const SINGLE_REFUND = 'SingleRefund';

	private $apiBaseUrl;
	private $merchantId;
	private $signKey;

	/**
	 * @param $apiBaseUrl
	 * @param $merchantId
	 * @param $signKey
	 */
	public function __construct(
		$apiBaseUrl,
		$merchantId,
		$signKey
	) {
		$this->apiBaseUrl = $apiBaseUrl;
		$this->merchantId = $merchantId;
		$this->signKey = $signKey;
	}

	/**
	 * @return string
	 */
	public function getVerifyKey()
	{
		return $this->signKey;
	}

	/**
	 * @param $requestName
	 * @return mixed
	 */
	public function create($requestName)
	{
		$class = __NAMESPACE__ . '\Request\\' . $requestName;
		return new $class(
			$this->apiBaseUrl,
			$this->merchantId,
			$this->signKey
		);
	}
}