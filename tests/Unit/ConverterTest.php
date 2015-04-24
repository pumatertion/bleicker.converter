<?php

namespace Tests\Bleicker\Converter\Unit;

use Bleicker\Converter\Converter;
use Bleicker\Converter\TypeConverter\TypeConverterInterface;
use Tests\Bleicker\Converter\Unit\Fixtures\TypeConverter\TestTypeConverter;
use Tests\Bleicker\Converter\UnitTestCase;

/**
 * Class ConverterTest
 *
 * @package Tests\Bleicker\Converter\Unit
 */
class ConverterTest extends UnitTestCase {

	/**
	 * @test
	 */
	public function registerUnregisterTypeConverterTest() {
		$alias = TestTypeConverter::class;
		Converter::register($alias, new TestTypeConverter());
		$this->assertInstanceOf(TypeConverterInterface::class, Converter::get($alias), 'TypeConverter is registered');
		Converter::unregister($alias);
		$this->assertNull(Converter::get($alias), 'TypeConverter is not registered');
	}

	/**
	 * @test
	 */
	public function convertWithTestTypeConverter() {
		$alias = TestTypeConverter::class;
		Converter::register($alias, new TestTypeConverter());
		$this->assertEquals('converted', Converter::convert('foo', 'bar'), 'Is converted to expected result');
	}
}
