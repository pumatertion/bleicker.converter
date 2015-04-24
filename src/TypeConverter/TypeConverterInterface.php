<?php

namespace Bleicker\Converter\TypeConverter;

/**
 * Interface TypeConverterInterface
 *
 * @package Bleicker\Converter\TypeConverter
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
}
