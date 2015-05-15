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
	 * @var integer
	 */
	protected $priority;

	/**
	 * @var LocalesInterface
	 */
	protected $locales;

	/**
	 * @var ConverterInterface
	 */
	protected $converter;

	/**
	 * @param integer $priority
	 */
	public function __construct($priority = NULL) {
		$this->priority = $priority === NULL ? 0 : $priority;
		$this->converter = ObjectManager::get(ConverterInterface::class, Converter::class);
		$this->locales = ObjectManager::get(LocalesInterface::class, Locales::class);
	}

	/**
	 * @return integer
	 */
	public function getPriority() {
		return $this->priority;
	}

	/**
	 * @param integer $priority
	 * @return TypeConverterInterface
	 */
	public static function register($priority = NULL) {
		$alias = static::class;
		$arguments = ['priority' => (integer)$priority];
		$arguments = array_merge($arguments, array_slice(func_get_args(), 1));
		$reflection = new ReflectionClass(static::class);
		/** @var TypeConverterInterface $instance */
		$instance = $reflection->newInstanceArgs($arguments);
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
	public function getConverter() {
		return $this->converter;
	}
}
