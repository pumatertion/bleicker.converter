<?php

namespace Bleicker\Converter;

use Bleicker\Container\AbstractContainer;
use Bleicker\Converter\Exception\NoTypeConverterFoundException;
use Closure;

/**
 * Class Converter
 *
 * @package Bleicker\Converter
 */
class Converter extends AbstractContainer implements ConverterInterface {

	/**
	 * @var array
	 */
	public static $storage = [];

	/**
	 * @param string $alias
	 * @return TypeConverterInterface
	 */
	public static function get($alias) {
		return parent::get($alias);
	}

	/**
	 * @param string $alias
	 * @param TypeConverterInterface $data
	 * @return static
	 */
	public static function add($alias, $data) {
		return parent::add($alias, $data);
	}

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return mixed
	 * @throws NoTypeConverterFoundException
	 */
	public static function convert($source = NULL, $targetType) {
		$possibleTypeConverters = static::resolveMatchingTypeConverter($source, $targetType);
		$typeConverter = static::resolveConverterWithHighestPriority($possibleTypeConverters);
		if ($typeConverter === NULL) {
			throw new NoTypeConverterFoundException('Could not find any suitable TypeConverter to convert "' . gettype($source) . '" to "' . $targetType . '"', 1429829310);
		}
		return $typeConverter->convert($source);
	}

	/**
	 * @param array $typeConverters
	 * @return TypeConverterInterface
	 */
	protected static function resolveConverterWithHighestPriority(array $typeConverters = array()) {
		/** @var TypeConverterInterface $highestPriorityTypeConverter */
		$highestPriorityTypeConverter = NULL;
		/** @var TypeConverterInterface $typeConverter */
		foreach ($typeConverters as $typeConverter) {
			if($highestPriorityTypeConverter === NULL){
				$highestPriorityTypeConverter = $typeConverter;
				continue;
			}
			if ($typeConverter->getPriority() > $highestPriorityTypeConverter->getPriority()) {
				$highestPriorityTypeConverter = $typeConverter;
				continue;
			}
		}
		return $highestPriorityTypeConverter;
	}

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return array
	 */
	protected static function resolveMatchingTypeConverter($source = NULL, $targetType) {
		return array_filter(self::$storage, static::getTypeConverterMatchingClosure($source, $targetType));
	}

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return Closure
	 */
	protected static function getTypeConverterMatchingClosure($source = NULL, $targetType) {
		return function (TypeConverterInterface $typeConverter) use ($source, $targetType) {
			return $typeConverter::canConvert($source, $targetType);
		};
	}
}
