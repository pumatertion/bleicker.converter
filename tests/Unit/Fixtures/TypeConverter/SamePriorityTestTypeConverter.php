<?php

namespace Tests\Bleicker\Converter\Unit\Fixtures\TypeConverter;

/**
 * Class TestTypeConverter
 *
 * @package Tests\Bleicker\Converter\Unit\Fixtures\TypeConverter
 */
class SamePriorityTestTypeConverter extends TestTypeConverter {

	/**
	 * @param integer $source
	 * @return string
	 */
	public function convert($source) {
		return 'matched by priority';
	}
}
