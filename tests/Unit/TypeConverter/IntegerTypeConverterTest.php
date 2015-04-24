<?php

namespace Tests\Bleicker\Converter\Unit\TypeConverter;

use Bleicker\Converter\TypeConverter\IntegerTypeConverter;
use Tests\Bleicker\Converter\UnitTestCase;

/**
 * Class IntegerTypeConverterTest
 *
 * @package Tests\Bleicker\Converter\Unit\TypeConverter
 */
class IntegerTypeConverterTest extends UnitTestCase {

	/**
	 * @test
	 */
	public function canConvertTest() {
		$this->assertTrue(IntegerTypeConverter::canConvert('123', 'int'), 'Can convert from string "123" to int');
		$this->assertTrue(IntegerTypeConverter::canConvert('123', 'integer'), 'Can convert from "123" to integer');
		$this->assertFalse(IntegerTypeConverter::canConvert(NULL, 'int'), 'Can not convert from NULL to int');
		$this->assertFalse(IntegerTypeConverter::canConvert(NULL, 'integer'), 'Can not convert from NULL to integer');
	}

	/**
	 * @test
	 */
	public function convertTest() {
		$converter = new IntegerTypeConverter();
		$this->assertEquals(123, $converter->convert('123'), 'Converts "123"');
		$this->assertEquals(-123, $converter->convert('-123'), 'Converts "-123"');
		$this->assertEquals(-123, $converter->convert('-123.5'), 'Converts "-123.5"');
		$this->assertEquals(0, $converter->convert('avc'), 'Converts "avc"');
		$this->assertEquals(-1, $converter->convert('-1ave22c'), 'Converts "-1ave22c"');
		$this->assertEquals(-0, $converter->convert('-0.34'), 'Converts "-0.34"');
		$this->assertEquals(-1, $converter->convert('-1,34'), 'Converts "-1,34"');
		$this->assertEquals(0, $converter->convert('-,34'), 'Converts "-,34"');
		$this->assertEquals(0, $converter->convert(FALSE), 'Converts FALSE');
		$this->assertEquals(1, $converter->convert(TRUE), 'Converts FALSE');
	}
}
