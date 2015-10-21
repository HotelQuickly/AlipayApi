<?php

namespace HQ\AlipayApi\Request;
use HQ\AlipayApi\CoreFunction;

/**
 * Class RequestAbstract
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
abstract class RequestAbstract
{
	use CoreFunction;

	const SIGN_TYPE = 'MD5';
	const INPUT_CHARSET = 'utf-8';

	const METHOD_POST = 'POST';
	const METHOD_GET = 'GET';

	protected $apiBaseUrl;
	protected $merchantId;
	protected $signKey;

	protected $params = [];

	protected $_serviceName;
	protected $_method;
	protected $_mandatoryParams = [];
	protected $_optionalParams = [];

	public function __construct(
		$apiBaseUrl,
		$merchantId,
		$signKey
	) {
		$this->apiBaseUrl = $apiBaseUrl;
		$this->merchantId = $merchantId;
		$this->signKey = $signKey;

		$this->params['partner'] = $this->merchantId;
		$this->params['_input_charset'] = self::INPUT_CHARSET;
		$this->params['sign_type'] = self::SIGN_TYPE;

		$this->params['service'] = $this->_serviceName;
	}

	public function getApiBaseUrl()
	{
		return $this->apiBaseUrl;
	}

	public function getMethod()
	{
		return $this->_method;
	}

	public function getParams()
	{
		return $this->params;
	}

	public function setParam($name, $value)
	{
		if ( !in_array($name, $this->getKeys($this->_mandatoryParams)) AND !in_array($name, $this->getKeys($this->_optionalParams)) ) {
			throw new \Exception("Trying to set un-allowed param: {$name}");
		}
		$this->params[$name] = $value;

		return $this;
	}

	public function getParam($name)
	{
		if ( !in_array($name, $this->getKeys($this->params)) ) {
			throw new \Exception("Trying to get unknown param: {$name}");
		}
		return $this->params[$name];
	}

	public function validateRequest()
	{
		// validate mandatoryParams
		$missingParamArray = array_diff_key($this->getKeys($this->_mandatoryParams), $this->getKeys($this->params));
		if ( !empty($missingParamArray) ) {
			throw new \Exception("Missing mandatory params: ". implode(',', $missingParamArray));
		}
	}

	public function handleResponse($apiResponse)
	{
		try {
			$xmlData = new \SimpleXMLElement($apiResponse);
			$xmlDataObject = (object) (array) $xmlData;
		} catch (\Exception $e) {
			throw new \Exception("Cannot create XML element:". $apiResponse);
		}

		return $xmlDataObject;
	}

	public function addSignToPayload()
	{
		$this->params['sign'] = $this->buildRequestSign(self::SIGN_TYPE, $this->signKey, $this->params);
	}
}