<?php

namespace HQ\AlipayApi;
use HQ\AlipayApi\Request\RequestAbstract;

/**
 * Class Sender
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class Sender
{
	public function send(RequestAbstract $request, $cacertUrl)
	{
		$request->addSignToPayload();

		$url = $request->getApiBaseUrl();

		$response = null;
		if ($request->getMethod() === RequestAbstract::METHOD_POST) {
			$response = $this->sendPOST($url, $cacertUrl, json_encode($request->getParams()));
		} elseif ($request->getMethod() === RequestAbstract::METHOD_GET) {
			$response = $this->sendGET($url, $cacertUrl, str_replace(' ','+',$request->buildParams($request->getParams())));
		}

		return $response;
	}

	private function sendPOST($url, $cacertUrl, $payload)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_CAINFO, $cacertUrl);
		$response = curl_exec($ch);

		if ( $curlError = curl_error($ch) ) {
			throw new \Exception('CURL_ERROR: '. $curlError);
		}

		curl_close($ch);

		return $response;
	}

	private function sendGET($url, $cacertUrl, $payload)
	{
		$ch = curl_init($url.'?'.$payload);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_CAINFO, $cacertUrl);
		$response = curl_exec($ch);

		if ( $curlError = curl_error($ch) ) {
			throw new \Exception('CURL_ERROR: '. $curlError);
		}

		curl_close($ch);

		return $response;
	}
}