<?php

namespace Tests\Bleicker\Converter\Unit\Fixtures\TypeConverter;

use Bleicker\Converter\TypeConverter\TypeConverterInterface;

/**
 * Class TestTypeConverter
 *
 * @package Tests\Bleicker\Converter\Unit\Fixtures\TypeConverter
 */
class TestTypeConverter implements TypeConverterInterface {

	/**
	 * @param mixed $source
	 * @param string $targetType
	 * @return boolean
	 */
	public static function canConvert($source = NULL, $targetType) {
		return TRUE;
	}

	/**
	 * @param integer $source
	 * @return string
	 */
	public function convert($source) {
		return 'converted';
	}
}
