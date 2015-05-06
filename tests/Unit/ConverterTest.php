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
		TestTypeConverter::register('foo');
		$this->assertInstanceOf(TestTypeConverter::class, Converter::get('foo'), 'TypeConverter is registered');

		Converter::remove('foo');
		$this->assertFalse(Converter::has('foo'));
		$this->assertNull(Converter::get('foo'));
	}

	/**
	 * @test
	 */
	public function convertWithTestTypeConverterTest() {
		TestTypeConverter::register('foo');
		$this->assertEquals('converted', Converter::convert('foo', 'bar'), 'Is converted to expected result');
	}

	/**
	 * @test
	 */
	public function constructorTestTest() {
		TestTypeConverter::register('foo', 'hello world');
		/** @var TestTypeConverter $typeConverter */
		$typeConverter = Converter::get('foo');
		$this->assertEquals('hello world', $typeConverter->foo);
	}

	/**
	 * @test
	 * @expectedException \Bleicker\Converter\Exception\MultipleTypeConvertersFoundException
	 */
	public function multiMatchingConverterTest() {
		TestTypeConverter::register('foo');
		TestTypeConverter::register('bar');
		Converter::convert('foo', 'bar');
	}

	/**
	 * @test
	 * @expectedException \Bleicker\Converter\Exception\NoTypeConverterFoundException
	 */
	public function noConverterFoundTest() {
		Converter::convert('foo', 'bar');
	}


}
