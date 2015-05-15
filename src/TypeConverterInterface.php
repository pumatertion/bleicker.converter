<?php

namespace Bleicker\Converter;

/**
 * Interface TypeConverterInterface
 *
 * @package Bleicker\Converter
 */
interface TypeConverterInterface {

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return boolean
	 */
	public static function canConvert($source = NULL, $targetType);

	/**
	 * @param mixed $source
	 * @return mixed
	 */
	public function convert($source);

	/**
	 * @param integer $priority
	 * @return TypeConverterInterface
	 */
	public static function register($priority = NULL);

	/**
	 * @return ConverterInterface
	 */
	public function getConverter();

	/**
	 * @return integer
	 */
	public function getPriority();
}
