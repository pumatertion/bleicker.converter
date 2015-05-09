<?php

namespace Bleicker\Converter;

use Bleicker\ObjectManager\ObjectManager;
use Bleicker\Translation\Locales;
use Bleicker\Translation\LocalesInterface;
use ReflectionClass;

/**
 * Class AbstractTypeConverter
 *
 * @package Bleicker\Converter
 */
abstract class AbstractTypeConverter implements TypeConverterInterface {

	/**
	 * @var LocalesInterface
	 */
	protected $locales;

	/**
	 * @var ConverterInterface
	 */
	protected $converter;

	public function __construct() {
		$this->converter = ObjectManager::get(ConverterInterface::class, Converter::class);
		$this->locales = ObjectManager::get(LocalesInterface::class, Locales::class);
	}

	/**
	 * @param string $alias
	 * @return TypeConverterInterface
	 */
	public static function register($alias = NULL) {
		if ($alias === NULL) {
			$alias = static::class;
		}
		$reflection = new ReflectionClass(static::class);
		/** @var TypeConverterInterface $instance */
		$instance = $reflection->newInstanceArgs(array_slice(func_get_args(), 1));
		/** @var ConverterInterface $converter */
		$converter = ObjectManager::get(ConverterInterface::class, Converter::class);
		$converter->add($alias, $instance);
		return $instance;
	}

	/**
	 * @return boolean
	 */
	public function isLocalizationMode() {
		$systemLocale = $this->locales->getSystemLocale();
		$defaultLocale = $this->locales->getDefault();
		return (string)$defaultLocale !== (string)$systemLocale;
	}

	/**
	 * @return ConverterInterface
	 */
	public function getConverter(){
		return $this->converter;
	}
}
