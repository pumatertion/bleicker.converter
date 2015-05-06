<?php

namespace Bleicker\Converter\TypeConverter;

use Bleicker\Converter\AbstractTypeConverter;

/**
 * Class FloatTypeConverter
 *
 * @package Bleicker\Converter\TypeConverter
 */
class FloatTypeConverter extends AbstractTypeConverter {

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return boolean
	 */
	public static function canConvert($source = NULL, $targetType) {
		if ($source !== NULL && in_array($targetType, ['float', 'double']) && (float)$source) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * @param mixed $source
	 * @return mixed
	 */
	public function convert($source) {
		return (float)$source;
	}
}
