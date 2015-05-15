<?php

namespace Tests\Bleicker\Converter\Unit;

use Bleicker\Converter\Converter;
use Bleicker\Converter\TypeConverter\TypeConverterInterface;
use Tests\Bleicker\Converter\Unit\Fixtures\TypeConverter\SamePriorityTestTypeConverter;
use Tests\Bleicker\Converter\Unit\Fixtures\TypeConverter\TestTypeConverter;
use Tests\Bleicker\Converter\UnitTestCase;

/**
 * Class ConverterTest
 *
 * @package Tests\Bleicker\Converter\Unit
 */
class ConverterTest extends UnitTestCase {

	protected function setUp() {
		parent::setUp();
		Converter::prune();
	}

	protected function tearDown() {
		parent::tearDown();
		Converter::prune();
	}

	/**
	 * @test
	 */
	public function registerUnregisterTypeConverterTest() {
		TestTypeConverter::register();
		$this->assertInstanceOf(TestTypeConverter::class, Converter::get(TestTypeConverter::class), 'TypeConverter is registered');

		Converter::remove(TestTypeConverter::class);
		$this->assertFalse(Converter::has(TestTypeConverter::class));
		$this->assertNull(Converter::get(TestTypeConverter::class));
	}

	/**
	 * @test
	 */
	public function convertWithTestTypeConverterTest() {
		TestTypeConverter::register();
		$this->assertEquals('converted', Converter::convert('foo', 'bar'), 'Is converted to expected result');
	}

	/**
	 * @test
	 */
	public function constructorTestTest() {
		TestTypeConverter::register(0, 'hello world');
		/** @var TestTypeConverter $typeConverter */
		$typeConverter = Converter::get(TestTypeConverter::class);
		$this->assertEquals('hello world', $typeConverter->foo);
	}

	/**
	 * @test
	 */
	public function multiMatchingConverterConvertsByHigherPriorityTest() {
		SamePriorityTestTypeConverter::register(10);
		TestTypeConverter::register(20);
		$convertedResult = Converter::convert('foo', 'bar');
		$this->assertEquals('converted', $convertedResult);
	}

	/**
	 * @test
	 * @expectedException \Bleicker\Converter\Exception\NoTypeConverterFoundException
	 */
	public function noConverterFoundTest() {
		Converter::convert('foo', 'bar');
	}
}
