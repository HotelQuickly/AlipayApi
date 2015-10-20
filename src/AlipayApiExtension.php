<?php
namespace HQ\AlipayApi;
use Nette;
// compatibility for nette 2.0.x and 2.1.x
if (!class_exists('Nette\DI\CompilerExtension')) {
	class_alias('Nette\Config\CompilerExtension', 'Nette\DI\CompilerExtension');
}

/**
 * Class AlipayApiExtension
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class AlipayApiExtension extends Nette\DI\CompilerExtension
{
	public $defaults = array(
		'apiBaseUrl' => '',
		'merchantId' => '',
		'signKey' => '',
		'cacertFileName' => ''
	);

	public function loadConfiguration()
	{
		$config = $this->getConfig($this->defaults);
		$builder = $this->getContainerBuilder();

		// add service alipayRequestFactory
		$builder->addDefinition('alipayRequestFactory')
			->setClass('\HQ\AlipayApi\RequestFactory', array($config['apiBaseUrl'], $config['merchantId'], $config['signKey']));

		// add service alipayManager
		$builder->addDefinition('alipayManager')
			->setClass('\HQ\AlipayApi\Manager', array($config['cacertFileName'], '@alipayRequestFactory'));
	}
}