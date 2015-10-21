<?php

namespace HQ\AlipayApi;

/**
 * Class Manager
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class Manager
{
	/** @var string */
	private $cacertFileName;

	/** @var Sender  */
	private $sender;

	/** @var RequestFactory  */
	private $requestFactory;

	/**
	 * @param $cacertFileName
	 * @param RequestFactory $requestFactory
	 */
	public function __construct(
		$cacertFileName,
		RequestFactory $requestFactory
	) {
		$this->sender = new Sender();
		$this->cacertFileName = $cacertFileName;
		$this->requestFactory = $requestFactory;
	}

	/**
	 * @return RequestFactory
	 */
	public function getRequestFactory()
	{
		return $this->requestFactory;
	}

	/**
	 * @param $requestName
	 * @param callable $callback
	 * @return mixed
	 */
	public function send($requestName, \Closure $callback = null)
	{
		$request = $this->requestFactory->create($requestName);

		if ($callback) {
			$callback($request);
		}

		// validate request
		$request->validateRequest();

		$cacertUrl = __DIR__.'/../cacert/'.$this->cacertFileName;
		$apiResponse = $this->sender->send($request, $cacertUrl);
		return $request->handleResponse($apiResponse);
	}

}