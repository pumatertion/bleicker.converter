<?php

namespace Bleicker\Converter\TypeConverter;

use Bleicker\Converter\AbstractTypeConverter;

/**
 * Class IntegerTypeConverter
 *
 * @package Bleicker\Converter\TypeConverter
 */
class IntegerTypeConverter extends AbstractTypeConverter {

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return boolean
	 */
	public static function canConvert($source = NULL, $targetType) {
		if ($source !== NULL && in_array($targetType, ['int', 'integer']) && (integer)$source) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * @param mixed $source
	 * @return mixed
	 */
	public function convert($source) {
		return (integer)$source;
	}
}
