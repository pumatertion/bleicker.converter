<?php

namespace Bleicker\Converter\TypeConverter;

use Bleicker\Converter\ConverterInterface;

/**
 * Class StringTypeConverter
 *
 * @package Bleicker\Converter\TypeConverter
 */
class StringTypeConverter implements TypeConverterInterface {

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return boolean
	 */
	public static function canConvert($source = NULL, $targetType) {
		if ($source !== NULL && $targetType === ConverterInterface::STRING && (string)$source) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * @param mixed $source
	 * @return mixed
	 */
	public function convert($source) {
		return (string)$source;
	}
}
