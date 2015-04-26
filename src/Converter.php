<?php

namespace Bleicker\Converter;

use Bleicker\Converter\Exception\MultipleTypeConvertersFoundException;
use Bleicker\Converter\Exception\NoTypeConverterFoundException;
use Bleicker\Converter\TypeConverter\TypeConverterInterface;
use Closure;

/**
 * Class Converter
 *
 * @package Bleicker\Converter
 */
class Converter implements ConverterInterface {

	/**
	 * @param string $alias
	 * @param TypeConverterInterface $typeConverter
	 * @return static
	 */
	public static function register($alias, TypeConverterInterface $typeConverter) {
		Container::add($alias, $typeConverter);
		return new static;
	}

	/**
	 * @param string $alias
	 * @return static
	 */
	public static function unregister($alias) {
		Container::remove($alias);
		return new static;
	}

	/**
	 * @param string $alias
	 * @return TypeConverterInterface|NULL
	 */
	public static function get($alias) {
		return Container::get($alias);
	}

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return mixed
	 * @throws Exception\MultipleTypeConvertersFoundException
	 * @throws Exception\NoTypeConverterFoundException
	 */
	public static function convert($source = NULL, $targetType) {
		$possibleTypeConverters = static::resolveMatchingTypeConverter($source, $targetType);
		if (count($possibleTypeConverters) === 0) {
			throw new NoTypeConverterFoundException('Could not find any suitable TypeConverter to convert "' . gettype($source) . '" to "' . $targetType . '"', 1429829310);
		}
		if (count($possibleTypeConverters) > 1) {
			throw new MultipleTypeConvertersFoundException('Multiple suitable TypeConverters found. Can\'t decide which one to use for converting  from "' . gettype($source) . '" to "' . $targetType . '"', 1429829311);
		}
		/** @var TypeConverterInterface $typeConverter */
		$typeConverter = array_shift($possibleTypeConverters);
		return $typeConverter->convert($source);
	}

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return array
	 */
	protected static function resolveMatchingTypeConverter($source = NULL, $targetType) {
		return array_filter(Container::storage(), static::getTypeConverterMatchingClosure($source, $targetType));
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

	/**
	 * @return static
	 */
	public static function prune() {
		Container::prune();
		return new static;
	}
}
