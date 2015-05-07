<?php

namespace Bleicker\Converter;

use Bleicker\ObjectManager\ObjectManager;
use ReflectionClass;

/**
 * Class AbstractTypeConverter
 *
 * @package Bleicker\Converter
 */
abstract class AbstractTypeConverter implements TypeConverterInterface {

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
		$converter = ObjectManager::isRegistered(ConverterInterface::class) ? ObjectManager::get(ConverterInterface::class) : ObjectManager::get(Converter::class);
		$converter->add($alias, $instance);
		return $instance;
	}
}
