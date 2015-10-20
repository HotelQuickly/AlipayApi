<?php

namespace HQ\Alipay;

/**
 * Class CoreFunction
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
trait CoreFunction
{
	/**
	 * @param array $data
	 * @return array
	 */
	public function getKeys(array $data)
	{
		$keys = [];
		foreach($data as $key => $val) {
			$keys[] = is_string($key) ? $key : $val;
		}

		return $keys;
	}

	public function buildParams(array $params)
	{
		$string = '';
		foreach ($params as $k=>$v) {
			$string .= $k.'='.$v.'&';
		}

		// remove escape characters if any
		if (get_magic_quotes_gpc()) {
			$string = stripslashes($string);
		}

		return rtrim($string, '&');
	}

	/**
	 * @param $signType
	 * @param $signKey
	 * @param array $params
	 * @return string
	 */
	public function buildRequestSign($signType, $signKey, array $params)
	{
		$paraFiltered = $this->paraFilter($params);

		$paraSorted = $this->argSort($paraFiltered);
		print_r($paraSorted);

		$preStr = $this->buildParams($paraSorted);

		switch ($signType) {
			case "MD5" :
				$mySign = $this->md5Sign($preStr, $signKey);
				break;
			default :
				$mySign = "";
		}

		return $mySign;
	}

	/***
	 * @param array $params
	 * @return array
	 */
	private function paraFilter(array $params)
	{
		$paraFiltered = array();
		while (list ($key, $val) = each ($params)) {
			if($key == "sign" || $key == "sign_type" || $val == "")continue;
			else	$paraFiltered[$key] = $params[$key];
		}
		return $paraFiltered;
	}

	/**
	 * @param array $params
	 * @return array
	 */
	private function argSort(array $params)
	{
		ksort($params);
		reset($params);
		return $params;
	}

	/**
	 * @param $preStr
	 * @param $key
	 * @return string
	 */
	private function md5Sign($preStr, $key) {
		$preStr = $preStr . $key;
		return md5($preStr);
	}

	/**
	 * @param $preStr
	 * @param $sign
	 * @param $key
	 * @return bool
	 */
	private function md5Verify($preStr, $sign, $key) {
		$preStr = $preStr . $key;
		$mySign = md5($preStr);

		if($mySign == $sign) {
			return true;
		}
		else {
			return false;
		}
	}
}